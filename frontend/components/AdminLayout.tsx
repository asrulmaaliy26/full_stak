
import React, { useEffect, useState } from 'react';
import { Outlet, useNavigate, useLocation } from 'react-router-dom';
import AdminSidebar from './AdminSidebar';
import { Menu } from 'lucide-react';

const AdminLayout: React.FC<{ children?: React.ReactNode }> = ({ children }) => {
  const navigate = useNavigate();
  const location = useLocation();
  const [sidebarOpen, setSidebarOpen] = useState(false);

  useEffect(() => {
    // Check authentication
    const authToken = sessionStorage.getItem('admin_auth_token');

    // If not authenticated and not currently on the login page (though layout typically wraps protected routes)
    // IMPORTANT: The login route itself should NOT be wrapped in AdminLayout if AdminLayout enforces auth, 
    // OR AdminLayout needs to handle the login route exception.
    // However, usually Login page is separate.
    if (!authToken) {
      navigate('/admin/login', { replace: true, state: { from: location } });
    }
  }, [navigate, location]);

  return (
    <div className="min-h-screen bg-slate-50 flex flex-col lg:flex-row">
      {/* Sidebar which handles its own mobile visibility via props */}
      <AdminSidebar isOpen={sidebarOpen} onClose={() => setSidebarOpen(false)} />

      <div className="flex-1 lg:ml-64 min-h-screen flex flex-col">
        {/* Mobile Header / Navbar */}
        <div className="lg:hidden bg-white border-b border-slate-200 p-4 sticky top-0 z-30 flex items-center gap-4 shadow-sm">
          <button
            onClick={() => setSidebarOpen(true)}
            className="p-2 -ml-2 hover:bg-slate-100 rounded-lg text-slate-600 transition-colors"
            aria-label="Open Menu"
          >
            <Menu className="w-6 h-6" />
          </button>
          <h1 className="font-bold text-slate-800 text-lg">Admin Panel</h1>
        </div>

        {/* Main Content Area */}
        <div className="flex-grow">
          {children || <Outlet />}
        </div>
      </div>
    </div>
  );
};

export default AdminLayout;
