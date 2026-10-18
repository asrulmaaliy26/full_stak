import { GoogleGenAI } from "@google/genai";

const getApiKey = (): string => {
  const key =
    process.env.API_KEY ||
    process.env.GEMINI_API_KEY ||
    (import.meta as any).env?.VITE_GEMINI_API_KEY ||
    (import.meta as any).env?.GEMINI_API_KEY ||
    '';
  return key;
};

const getAiClient = () => {
  const apiKey = import.meta.env.VITE_GEMINI_API_KEY || import.meta.env.GEMINI_API_KEY || '';
  if (!apiKey || apiKey === 'PLACEHOLDER_API_KEY') {
    return null;
  }
  return new GoogleGenAI({ apiKey });
};

const CANDIDATE_MODELS = ['gemini-3.8-flash', 'gemini-3-flash-preview', 'gemini-flash-latest'];

export const YAYASAN_SYSTEM_INSTRUCTION = `
Anda adalah Asisten Virtual Resmi Lembaga Pendidikan Islam (LPI) Al Hidayah & Yayasan Pendidikan Al Mannan Kauman Tulungagung.
Tugas Anda adalah melayani pertanyaan pengunjung web, calon wali santri, calon siswa/mahasiswa, dan masyarakat umum secara ramah, sopan, solutif, serta bernuansa Islami dan Qurani.

KNOWLEDGE BASE & INFORMASI LENGKAP LEMBAGA:

1. PROFIL LEMBAGA:
- Lembaga: Lembaga Pendidikan Islam (LPI) Al Hidayah / Yayasan Pendidikan Al Mannan.
- Karakter: Pendidikan Islam Terpadu berkarakter Qurani, memadukan IPTEK sains modern dan ilmu agama/turats.

2. UNIT-UNIT PENDIDIKAN DALAM YAYASAN:
- TPQ Al Mannan: Pendidikan baca tulis Al-Qur'an, tahsin, dan fasholatan dasar.
- MI Al Hidayah: Tingkat Ibtidaiyah (SD) berkarakter Qurani.
- SMPT Al Mannan: SMP Terpadu berbasis kepesantrenan.
- MA Al Hidayah: Madrasah Aliyah (setara SMA) unggul dalam tahfidz Al-Qur'an dan sains.
- Madin Al Mannan: Madrasah Diniyah Takmiliyah pendalaman kitab turats dan akhlak.
- STAI Al-Mannan: Perguruan Tinggi Islam dengan Program Studi S1 Ilmu Al-Qur'an dan Tafsir (IAT) bergelar S.Ag.

3. PROGRAM UNGGULAN:
- Program Tahfidz Al-Qur'an (target hingga 30 Juz bersanad).
- Kurikulum Terpadu: Kurikulum Kemendikbudristek/Kemenag + Kepesantrenan Klasik.
- Pembinaan Akhlak Rabbani & Kepemimpinan Umat.
- Penguasaan Bahasa Asing (Arab dan Inggris) aktif.
- Bimbingan Prestasi Sains, Olimpiade KSM, MTQ/Tahfidz, Kaligrafi, dan Karya Ilmiah.

4. INFORMASI PPDB & PENDAFTARAN:
- Terbuka untuk semua jenjang (TPQ, MI, SMPT, MA, hingga STAI Al-Mannan).
- Tersedia Jalur Reguler, Jalur Prestasi, dan Jalur Beasiswa Tahfidz.
- Konsultasi pendaftaran online & info syarat/biaya dapat langsung menghubungi kontak WhatsApp resmi atau website.

5. KONTAK RESMI & ALAMAT:
- Alamat Kampus Pusat: Jl. KH Hasyim Asyari No.27, Kauman, Kec. Kauman, Kabupaten Tulungagung, Jawa Timur 66261.
- Kontak WhatsApp Admin & PPDB: 0815-5986-1036 (Ibu Mei)
- Email: lpialhidayahkauman@gmail.com
- Instagram: @lpialhidayahkauman
- Website: https://lpialhidayah.or.id

ATURAN MENJAWAB:
- Selalu awali dengan sapaan Islami yang santun (Assalamu'alaikum Warahmatullahi Wabarakatuh).
- Berikan jawaban yang terstruktur, akurat, dan mudah dipahami.
- Sertakan nomor WhatsApp Ibu Mei (0815-5986-1036) dan lokasi Kauman Tulungagung jika ditanya mengenai pendaftaran atau kontak.
`;

export const getSchoolAssistantResponse = async (
  userPrompt: string,
  history: Array<{ role: 'user' | 'bot'; text: string }> = []
): Promise<string> => {
  const ai = getAiClient();
  if (!ai) return "Maaf, asisten AI sedang tidak tersedia (API Key missing).";

  const contents: any[] = [];
  const recentHistory = history.slice(-6);
  for (const msg of recentHistory) {
    contents.push({
      role: msg.role === 'user' ? 'user' : 'model',
      parts: [{ text: msg.text }]
    });
  }
  contents.push({
    role: 'user',
    parts: [{ text: userPrompt }]
  });

  let lastError: any = null;
  for (const model of CANDIDATE_MODELS) {
    try {
      const response = await ai.models.generateContent({
        model: model,
        contents: contents,
        config: {
          systemInstruction: YAYASAN_SYSTEM_INSTRUCTION,
          temperature: 0.7,
        },
      });

      if (response.text) {
        return response.text;
      }
    } catch (error: any) {
      lastError = error;
      console.warn(`Model ${model} failed, trying fallback...`, error?.message);
    }
  }

  console.error("All Gemini models failed:", lastError);
  return "Maaf, terjadi gangguan saat menghubungi layanan AI: " + (lastError?.message || "Koneksi bermasalah");
};

export interface NewsPromptContext {
  briefDescription?: string;
  title?: string;
  category?: string;
  excerpt?: string;
  jenjang?: string;
  fakultas?: string;
  jurusan?: string;
  images?: (File | Blob | string | null | undefined)[];
}

// Convert File/Blob to Gemini inlineData base64 part
export const fileToGenerativePart = async (file: File | Blob): Promise<{ inlineData: { data: string; mimeType: string } } | null> => {
  return new Promise((resolve) => {
    try {
      const reader = new FileReader();
      reader.onloadend = () => {
        const resultStr = reader.result as string;
        if (resultStr && resultStr.includes(',')) {
          const base64Data = resultStr.split(',')[1];
          resolve({
            inlineData: {
              data: base64Data,
              mimeType: file.type || 'image/jpeg'
            }
          });
        } else {
          resolve(null);
        }
      };
      reader.onerror = () => resolve(null);
      reader.readAsDataURL(file);
    } catch {
      resolve(null);
    }
  });
};

// Convert image URL to Gemini inlineData base64 part
export const urlToGenerativePart = async (url: string): Promise<{ inlineData: { data: string; mimeType: string } } | null> => {
  try {
    const res = await fetch(url);
    if (!res.ok) return null;
    const blob = await res.blob();
    return await fileToGenerativePart(blob);
  } catch (e) {
    console.warn('Failed to fetch image URL for AI analysis:', url, e);
    return null;
  }
};

export const generateNewsArticle = async (
  contextOrDescription: string | NewsPromptContext
): Promise<string> => {
  const ai = getAiClient();
  if (!ai) return "Gagal generate berita: API Key tidak ditemukan.";

  const ctx: NewsPromptContext = typeof contextOrDescription === 'string'
    ? { briefDescription: contextOrDescription }
    : (contextOrDescription || {});

  // 1. Convert all valid images (File, Blob, or URL string) to base64 inlineData
  const imageParts: { inlineData: { data: string; mimeType: string } }[] = [];
  if (ctx.images && Array.isArray(ctx.images)) {
    for (const img of ctx.images) {
      if (!img) continue;
      if (img instanceof File || img instanceof Blob) {
        const part = await fileToGenerativePart(img);
        if (part) {
          imageParts.push(part);
        }
      } else if (typeof img === 'string' && img.trim()) {
        const part = await urlToGenerativePart(img.trim());
        if (part) {
          imageParts.push(part);
        }
      }
    }
  }

  // 2. Build structured base prompt from form metadata
  const promptParts: string[] = [];
  promptParts.push(`Anda adalah jurnalis dan humas profesional untuk Lembaga Pendidikan Islam (LPI) Al Hidayah & Al Mannan. Tugas Anda adalah menyusun artikel berita kegiatan yang lengkap, menarik, mendalam, dan bernuansa sekolah Islam unggul.`);

    if (imageParts.length > 0) {
    promptParts.push(`\n[ANALISIS FOTO DOKUMENTASI & POSTER - SANGAT PENTING]:
Ada ${imageParts.length} foto kegiatan / poster dokumentasi yang dilampirkan.
INSTRUKSI KHUSUS ANALISIS GAMBAR:
1. BACA SELURUH TEKS YANG TERCANTUM PADA SETIAP FOTO/POSTER!
2. Jika foto berupa poster ucapan selamat (congrats), piagam, atau dokumentasi prestasi:
   - WAJIB catat dan sebutkan SEMUA NAMA LENGKAP SISWA/SANTRI yang tercantum.
   - WAJIB catat dan sebutkan KATEGORI/PREDIKAT JUARA masing-masing (misal: Juara I, Juara II, Juara III, Juara Harapan I, II, III).
   - Cantumkan cabang lomba, kelas siswa, dan nama penyelenggara (seperti DPP AGPAII, Kemenag, dinas, dsb) jika tertera.
   - Sertakan semboyan/moto sekolah yang tertulis di poster (seperti "Mendidik Dengan Hati, Membangun Generasi Qur'ani").
3. Susun daftar rincian juara tersebut secara rapi dan terstruktur di dalam artikel berita menggunakan tag <ul> dan <li> dengan huruf tebal <strong> pada nama siswa dan juaranya.`);
  }

  const baseItems: string[] = [];
  if (ctx.title && ctx.title.trim() && ctx.title !== 'Judul Baru') {
    baseItems.push(`- Judul / Topik Berita: "${ctx.title.trim()}"`);
  }
  if (ctx.category && ctx.category.trim()) {
    baseItems.push(`- Kategori Kegiatan: ${ctx.category.trim()}`);
  }
  if (ctx.jenjang && ctx.jenjang.trim()) {
    baseItems.push(`- Jenjang: ${ctx.jenjang.trim()}`);
  }
  if (ctx.fakultas || ctx.jurusan) {
    baseItems.push(`- Fakultas/Jurusan: ${(ctx.fakultas || '')} ${(ctx.jurusan || '')}`);
  }
  if (ctx.excerpt && ctx.excerpt.trim()) {
    baseItems.push(`- Ringkasan / Poin Awal: "${ctx.excerpt.trim()}"`);
  }

  if (baseItems.length > 0) {
    promptParts.push(`\n[DATA & KONTEKS DASAR (BASE PROMPT)]:\n${baseItems.join('\n')}`);
  }

  if (ctx.briefDescription && ctx.briefDescription.trim()) {
    promptParts.push(`\n[POIN TAMBAHAN / INSTRUKSI KHUSUS DARI ADMIN]:\n"${ctx.briefDescription.trim()}"`);
  } else if (baseItems.length === 0 && imageParts.length === 0) {
    promptParts.push('\nBuatkan artikel berita kegiatan terkini yang menginspirasi.');
  }

    promptParts.push(`\n[KETENTUAN STRUKTUR DAN FORMAT ARTIKEL BERITA]:
1. Awali dengan judul berita yang kuat, menarik, dan representatif di dalam tag <h3>Judul Berita</h3>.
2. Paragraf 1 (Pembuka): Pembuka naratif yang hangat dan penuh rasa syukur atas capaian luar biasa, menyebutkan nama kegiatan dan lembaga penyelenggara.
3. Paragraf 2 (Latar Belakang & Persaingan): Gambaran umum kompetisi, ketatnya persaingan antar sekolah/peserta, dan kesiapan delegasi santri.
4. Paragraf 3 (Daftar Juara & Pemenang): Rincian lengkap prestasi para santri dalam daftar terstruktur (gunakan <ul><li> dengan <strong> untuk nama santri dan juaranya).
5. Paragraf 4 (Apresiasi & Sambutan): Kutipan ucapan selamat dan rasa bangga dari pimpinan sekolah atau guru pembimbing dengan tag <em>.
6. Paragraf 5 (Penutup & Doa): Harapan, motivasi bagi santri lain, doa keberkahan, serta penegasan komitmen mencetak generasi Qur'ani yang unggul.
7. Format output murni HTML. JANGAN sertakan tag <html>, <head>, atau <body>. Jangan gunakan wrapper markdown seperti \`\`\`html.`);

  const promptText = promptParts.join('\n');
  const contentsPayload: any[] = [...imageParts, { text: promptText }];

  let lastError: any = null;
  for (const model of CANDIDATE_MODELS) {
    try {
      const response = await ai.models.generateContent({
        model: model,
        contents: contentsPayload.length === 1 && typeof contentsPayload[0].text === 'string'
          ? contentsPayload[0].text
          : contentsPayload,
        config: {
          temperature: 0.7,
        },
      });

      let text = response.text || "";
      text = text.replace(/^\`\`\`html\s*/i, '').replace(/\`\`\`\s*$/i, '').trim();
      if (text) {
        return text;
      }
    } catch (error: any) {
      lastError = error;
      console.warn(`Model ${model} failed for multimodal news generation, trying fallback...`, error?.message);
    }
  }

  console.error("Gemini News Generation Error:", lastError);
  throw new Error(lastError?.message || "Gagal memproses AI");
};
