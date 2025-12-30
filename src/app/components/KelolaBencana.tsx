import Sidebar from './Sidebar';
import { Plus, Edit, Trash2, X, AlertCircle } from 'lucide-react';
import { useState } from 'react';

interface KelolaBencanaProps {
  navigateTo: (page: string, state?: any) => void;
}

interface Disaster {
  id: number;
  name: string;
  description: string;
  icon: string;
}

export default function KelolaBencana({ navigateTo }: KelolaBencanaProps) {
  const [disasters, setDisasters] = useState<Disaster[]>([
    { id: 1, name: 'Banjir', description: 'Bencana banjir dan genangan air', icon: '🌊' },
    { id: 2, name: 'Gempa Bumi', description: 'Guncangan dan getaran bumi', icon: '⚠️' },
    { id: 3, name: 'Tsunami', description: 'Gelombang laut raksasa', icon: '🌊' },
    { id: 4, name: 'Kebakaran Hutan', description: 'Kebakaran hutan dan lahan', icon: '🔥' },
    { id: 5, name: 'Tanah Longsor', description: 'Pergeseran tanah dan batuan', icon: '⛰️' },
    { id: 6, name: 'Badai', description: 'Badai dan angin topan', icon: '💨' },
    { id: 7, name: 'Kekeringan', description: 'Kekurangan air dalam waktu lama', icon: '☀️' },
    { id: 8, name: 'Gunung Meletus', description: 'Letusan gunung berapi', icon: '🌋' },
  ]);

  const [showModal, setShowModal] = useState(false);
  const [modalMode, setModalMode] = useState<'add' | 'edit'>('add');
  const [currentDisaster, setCurrentDisaster] = useState<Disaster | null>(null);
  const [formData, setFormData] = useState({
    name: '',
    description: '',
    icon: ''
  });
  const [errors, setErrors] = useState({
    name: '',
    description: ''
  });

  const openAddModal = () => {
    setModalMode('add');
    setFormData({ name: '', description: '', icon: '' });
    setErrors({ name: '', description: '' });
    setShowModal(true);
  };

  const openEditModal = (disaster: Disaster) => {
    setModalMode('edit');
    setCurrentDisaster(disaster);
    setFormData({
      name: disaster.name,
      description: disaster.description,
      icon: disaster.icon
    });
    setErrors({ name: '', description: '' });
    setShowModal(true);
  };

  const closeModal = () => {
    setShowModal(false);
    setCurrentDisaster(null);
    setFormData({ name: '', description: '', icon: '' });
    setErrors({ name: '', description: '' });
  };

  const validateForm = () => {
    const newErrors = {
      name: '',
      description: ''
    };

    if (!formData.name.trim()) {
      newErrors.name = 'Nama bencana harus diisi';
    }

    if (!formData.description.trim()) {
      newErrors.description = 'Deskripsi harus diisi';
    }

    setErrors(newErrors);
    return !Object.values(newErrors).some(error => error !== '');
  };

  const handleSubmit = () => {
    if (!validateForm()) return;

    if (modalMode === 'add') {
      const newDisaster: Disaster = {
        id: Math.max(...disasters.map(d => d.id)) + 1,
        name: formData.name,
        description: formData.description,
        icon: formData.icon || '📌'
      };
      setDisasters([...disasters, newDisaster]);
    } else if (modalMode === 'edit' && currentDisaster) {
      setDisasters(disasters.map(d => 
        d.id === currentDisaster.id 
          ? { ...d, name: formData.name, description: formData.description, icon: formData.icon }
          : d
      ));
    }

    closeModal();
  };

  const handleDelete = (id: number) => {
    if (confirm('Apakah Anda yakin ingin menghapus data bencana ini?')) {
      setDisasters(disasters.filter(d => d.id !== id));
    }
  };

  return (
    <div className="flex min-h-screen bg-gray-50">
      <Sidebar navigateTo={navigateTo} currentPage="kelola-bencana" role="admin" />

      <main className="flex-1 p-8">
        {/* Header */}
        <div className="mb-8">
          <h1 className="text-2xl text-gray-800 mb-2">Kelola Jenis Bencana</h1>
          <p className="text-gray-600">Manajemen data jenis bencana alam</p>
        </div>

        {/* Add Button */}
        <div className="mb-6">
          <button
            onClick={openAddModal}
            className="px-6 py-3 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors inline-flex items-center gap-2"
          >
            <Plus size={20} />
            Tambah Jenis Bencana
          </button>
        </div>

        {/* Table */}
        <div className="bg-white rounded-lg border border-gray-200">
          <div className="overflow-x-auto">
            <table className="w-full">
              <thead className="bg-gray-50 border-b border-gray-200">
                <tr>
                  <th className="px-6 py-3 text-left text-xs text-gray-600 uppercase tracking-wider w-16">
                    #
                  </th>
                  <th className="px-6 py-3 text-left text-xs text-gray-600 uppercase tracking-wider w-16">
                    Ikon
                  </th>
                  <th className="px-6 py-3 text-left text-xs text-gray-600 uppercase tracking-wider">
                    Nama Bencana
                  </th>
                  <th className="px-6 py-3 text-left text-xs text-gray-600 uppercase tracking-wider">
                    Deskripsi
                  </th>
                  <th className="px-6 py-3 text-left text-xs text-gray-600 uppercase tracking-wider w-32">
                    Aksi
                  </th>
                </tr>
              </thead>
              <tbody className="divide-y divide-gray-200">
                {disasters.map((disaster) => (
                  <tr key={disaster.id} className="hover:bg-gray-50">
                    <td className="px-6 py-4">
                      <span className="text-gray-600">{disaster.id}</span>
                    </td>
                    <td className="px-6 py-4">
                      <span className="text-2xl">{disaster.icon}</span>
                    </td>
                    <td className="px-6 py-4">
                      <p className="text-gray-800">{disaster.name}</p>
                    </td>
                    <td className="px-6 py-4">
                      <p className="text-gray-600 text-sm">{disaster.description}</p>
                    </td>
                    <td className="px-6 py-4">
                      <div className="flex items-center gap-2">
                        <button
                          onClick={() => openEditModal(disaster)}
                          className="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors"
                          title="Edit"
                        >
                          <Edit size={18} />
                        </button>
                        <button
                          onClick={() => handleDelete(disaster.id)}
                          className="p-2 text-red-600 hover:bg-red-50 rounded-lg transition-colors"
                          title="Hapus"
                        >
                          <Trash2 size={18} />
                        </button>
                      </div>
                    </td>
                  </tr>
                ))}
              </tbody>
            </table>
          </div>
        </div>
      </main>

      {/* Modal */}
      {showModal && (
        <div className="fixed inset-0 bg-black/50 flex items-center justify-center z-50 p-4">
          <div className="bg-white rounded-lg max-w-2xl w-full max-h-[90vh] overflow-y-auto">
            {/* Modal Header */}
            <div className="flex items-center justify-between p-6 border-b border-gray-200">
              <h2 className="text-xl text-gray-800">
                {modalMode === 'add' ? 'Tambah Jenis Bencana' : 'Edit Jenis Bencana'}
              </h2>
              <button
                onClick={closeModal}
                className="text-gray-400 hover:text-gray-600 transition-colors"
              >
                <X size={24} />
              </button>
            </div>

            {/* Modal Body */}
            <div className="p-6 space-y-4">
              <div>
                <label className="block text-gray-700 mb-2">
                  Nama Bencana <span className="text-red-500">*</span>
                </label>
                <input
                  type="text"
                  value={formData.name}
                  onChange={(e) => setFormData({ ...formData, name: e.target.value })}
                  placeholder="Contoh: Banjir"
                  className={`w-full border ${errors.name ? 'border-red-500' : 'border-gray-300'} rounded-lg px-4 py-3 text-gray-800 focus:outline-none focus:ring-2 focus:ring-green-500`}
                />
                {errors.name && (
                  <p className="mt-2 text-red-500 text-sm flex items-center gap-1">
                    <AlertCircle size={14} />
                    {errors.name}
                  </p>
                )}
              </div>

              <div>
                <label className="block text-gray-700 mb-2">
                  Deskripsi <span className="text-red-500">*</span>
                </label>
                <textarea
                  value={formData.description}
                  onChange={(e) => setFormData({ ...formData, description: e.target.value })}
                  placeholder="Deskripsi singkat tentang jenis bencana..."
                  rows={4}
                  className={`w-full border ${errors.description ? 'border-red-500' : 'border-gray-300'} rounded-lg px-4 py-3 text-gray-800 focus:outline-none focus:ring-2 focus:ring-green-500`}
                />
                {errors.description && (
                  <p className="mt-2 text-red-500 text-sm flex items-center gap-1">
                    <AlertCircle size={14} />
                    {errors.description}
                  </p>
                )}
              </div>

              <div>
                <label className="block text-gray-700 mb-2">
                  Ikon (Emoji)
                </label>
                <input
                  type="text"
                  value={formData.icon}
                  onChange={(e) => setFormData({ ...formData, icon: e.target.value })}
                  placeholder="Contoh: 🌊"
                  className="w-full border border-gray-300 rounded-lg px-4 py-3 text-gray-800 focus:outline-none focus:ring-2 focus:ring-green-500"
                />
                <p className="mt-2 text-sm text-gray-500">
                  Opsional. Gunakan emoji untuk representasi visual.
                </p>
              </div>
            </div>

            {/* Modal Footer */}
            <div className="flex items-center justify-end gap-3 p-6 border-t border-gray-200">
              <button
                onClick={closeModal}
                className="px-6 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors"
              >
                Batal
              </button>
              <button
                onClick={handleSubmit}
                className="px-6 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors"
              >
                {modalMode === 'add' ? 'Tambah' : 'Simpan'}
              </button>
            </div>
          </div>
        </div>
      )}
    </div>
  );
}
