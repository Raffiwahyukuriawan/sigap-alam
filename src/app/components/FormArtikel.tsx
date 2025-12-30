import Sidebar from './Sidebar';
import { Save, Send, ArrowLeft, Image as ImageIcon, AlertCircle } from 'lucide-react';
import { useState } from 'react';

interface FormArtikelProps {
  navigateTo: (page: string, state?: any) => void;
  editId?: number;
}

export default function FormArtikel({ navigateTo, editId }: FormArtikelProps) {
  const [formData, setFormData] = useState({
    title: editId ? 'Cara Menghadapi Banjir di Musim Hujan' : '',
    category: editId ? 'banjir' : '',
    content: editId ? 'Konten artikel yang sudah ada...' : '',
    image: null as File | null
  });

  const [errors, setErrors] = useState({
    title: '',
    category: '',
    content: ''
  });

  const [showSuccess, setShowSuccess] = useState(false);

  const categories = [
    { value: '', label: 'Pilih Kategori' },
    { value: 'banjir', label: 'Banjir' },
    { value: 'gempa', label: 'Gempa Bumi' },
    { value: 'tsunami', label: 'Tsunami' },
    { value: 'kebakaran', label: 'Kebakaran Hutan' },
    { value: 'longsor', label: 'Tanah Longsor' },
    { value: 'badai', label: 'Badai' },
    { value: 'kekeringan', label: 'Kekeringan' },
    { value: 'gunung', label: 'Gunung Meletus' },
  ];

  const handleInputChange = (field: string, value: any) => {
    setFormData(prev => ({ ...prev, [field]: value }));
    // Clear error when user types
    if (errors[field as keyof typeof errors]) {
      setErrors(prev => ({ ...prev, [field]: '' }));
    }
  };

  const validateForm = () => {
    const newErrors = {
      title: '',
      category: '',
      content: ''
    };

    if (!formData.title.trim()) {
      newErrors.title = 'Judul artikel harus diisi';
    }

    if (!formData.category) {
      newErrors.category = 'Kategori harus dipilih';
    }

    if (!formData.content.trim()) {
      newErrors.content = 'Konten artikel harus diisi';
    }

    setErrors(newErrors);
    return !Object.values(newErrors).some(error => error !== '');
  };

  const handleSaveDraft = () => {
    if (validateForm()) {
      setShowSuccess(true);
      setTimeout(() => {
        setShowSuccess(false);
        navigateTo('dashboard-kontributor');
      }, 2000);
    }
  };

  const handleSubmit = () => {
    if (validateForm()) {
      setShowSuccess(true);
      setTimeout(() => {
        setShowSuccess(false);
        navigateTo('dashboard-kontributor');
      }, 2000);
    }
  };

  return (
    <div className="flex min-h-screen bg-gray-50">
      <Sidebar navigateTo={navigateTo} currentPage="form-artikel" role="contributor" />

      <main className="flex-1 p-8">
        {/* Header */}
        <div className="mb-8">
          <button
            onClick={() => navigateTo('dashboard-kontributor')}
            className="inline-flex items-center gap-2 text-gray-600 hover:text-green-600 transition-colors mb-4"
          >
            <ArrowLeft size={20} />
            Kembali ke Dashboard
          </button>
          <h1 className="text-2xl text-gray-800 mb-2">
            {editId ? 'Edit Artikel' : 'Buat Artikel Baru'}
          </h1>
          <p className="text-gray-600">
            {editId ? 'Perbarui artikel edukasi Anda' : 'Tulis artikel edukasi tentang bencana alam'}
          </p>
        </div>

        {/* Success Message */}
        {showSuccess && (
          <div className="mb-6 p-4 bg-green-50 border border-green-200 rounded-lg flex items-center gap-3">
            <AlertCircle className="text-green-600" size={20} />
            <p className="text-green-800">Artikel berhasil disimpan!</p>
          </div>
        )}

        {/* Form */}
        <div className="bg-white rounded-lg border border-gray-200 p-8 max-w-4xl">
          <div className="space-y-6">
            {/* Title */}
            <div>
              <label className="block text-gray-700 mb-2">
                Judul Artikel <span className="text-red-500">*</span>
              </label>
              <input
                type="text"
                value={formData.title}
                onChange={(e) => handleInputChange('title', e.target.value)}
                placeholder="Masukkan judul artikel..."
                className={`w-full border ${errors.title ? 'border-red-500' : 'border-gray-300'} rounded-lg px-4 py-3 text-gray-800 focus:outline-none focus:ring-2 focus:ring-green-500`}
              />
              {errors.title && (
                <p className="mt-2 text-red-500 text-sm flex items-center gap-1">
                  <AlertCircle size={14} />
                  {errors.title}
                </p>
              )}
            </div>

            {/* Category */}
            <div>
              <label className="block text-gray-700 mb-2">
                Kategori <span className="text-red-500">*</span>
              </label>
              <select
                value={formData.category}
                onChange={(e) => handleInputChange('category', e.target.value)}
                className={`w-full border ${errors.category ? 'border-red-500' : 'border-gray-300'} rounded-lg px-4 py-3 text-gray-800 focus:outline-none focus:ring-2 focus:ring-green-500`}
              >
                {categories.map((cat) => (
                  <option key={cat.value} value={cat.value}>
                    {cat.label}
                  </option>
                ))}
              </select>
              {errors.category && (
                <p className="mt-2 text-red-500 text-sm flex items-center gap-1">
                  <AlertCircle size={14} />
                  {errors.category}
                </p>
              )}
            </div>

            {/* Image Upload */}
            <div>
              <label className="block text-gray-700 mb-2">
                Gambar Sampul
              </label>
              <div className="border-2 border-dashed border-gray-300 rounded-lg p-8 text-center hover:border-green-500 transition-colors cursor-pointer">
                <ImageIcon className="mx-auto text-gray-400 mb-3" size={48} />
                <p className="text-gray-600 mb-2">Klik untuk upload atau drag and drop</p>
                <p className="text-sm text-gray-500">PNG, JPG hingga 2MB</p>
                <input
                  type="file"
                  accept="image/*"
                  onChange={(e) => handleInputChange('image', e.target.files?.[0] || null)}
                  className="hidden"
                />
              </div>
              {formData.image && (
                <p className="mt-2 text-sm text-green-600">File terpilih: {formData.image.name}</p>
              )}
            </div>

            {/* Content Editor */}
            <div>
              <label className="block text-gray-700 mb-2">
                Konten Artikel <span className="text-red-500">*</span>
              </label>
              <textarea
                value={formData.content}
                onChange={(e) => handleInputChange('content', e.target.value)}
                placeholder="Tulis konten artikel di sini...&#10;&#10;Gunakan format markdown untuk memformat teks.&#10;&#10;Contoh:&#10;# Judul Besar&#10;## Sub Judul&#10;**Teks Tebal**&#10;*Teks Miring*"
                rows={15}
                className={`w-full border ${errors.content ? 'border-red-500' : 'border-gray-300'} rounded-lg px-4 py-3 text-gray-800 focus:outline-none focus:ring-2 focus:ring-green-500 font-mono text-sm`}
              />
              {errors.content && (
                <p className="mt-2 text-red-500 text-sm flex items-center gap-1">
                  <AlertCircle size={14} />
                  {errors.content}
                </p>
              )}
              <p className="mt-2 text-sm text-gray-500">
                Karakter: {formData.content.length}
              </p>
            </div>

            {/* Action Buttons */}
            <div className="flex items-center gap-4 pt-6 border-t border-gray-200">
              <button
                onClick={handleSaveDraft}
                className="px-6 py-3 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors inline-flex items-center gap-2"
              >
                <Save size={20} />
                Simpan Draft
              </button>
              <button
                onClick={handleSubmit}
                className="px-6 py-3 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors inline-flex items-center gap-2"
              >
                <Send size={20} />
                Kirim untuk Review
              </button>
            </div>

            {/* Info Box */}
            <div className="bg-blue-50 border border-blue-200 rounded-lg p-4">
              <p className="text-sm text-blue-800">
                <strong>Catatan:</strong> Setelah Anda mengirim artikel, artikel akan direview oleh admin 
                sebelum dipublikasikan. Anda akan mendapat notifikasi setelah artikel disetujui atau ditolak.
              </p>
            </div>
          </div>
        </div>
      </main>
    </div>
  );
}
