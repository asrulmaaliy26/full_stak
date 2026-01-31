Set-Location "$PSScriptRoot\frontend"
npm run build
if ($LASTEXITCODE -eq 0) {
    Set-Location "$PSScriptRoot"
    Copy-Item -Path "frontend\dist\*" -Destination "backend\public" -Recurse -Force
    Move-Item -Path "backend\public\index.html" -Destination "backend\resources\views\react_app.blade.php" -Force
    Write-Host "Frontend successfully built and deployed to Backend!" -ForegroundColor Green
} else {
    Write-Host "Build failed!" -ForegroundColor Red
}
