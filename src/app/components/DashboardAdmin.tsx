import Sidebar from './Sidebar';
import { FileText, AlertTriangle, Users, Lightbulb, Eye, CheckCircle, XCircle, TrendingUp } from 'lucide-react';
import { useState } from 'react';

interface DashboardAdminProps {
  navigateTo: (page: string, state?: any) => void;
}

export default function DashboardAdmin({ navigateTo }: DashboardAdminProps) {
  const [pendingArticles] = useState([
    {
      id: 1,
      title: 'Langkah Evakuasi Saat Gempa Bumi',
      author: 'Andi Prasetyo',
      category: 'Gempa Bumi',
      date: '18 Desember 2025',
    },
    {
      id: 2,
      title: 'Mengenal Sistem Peringatan Dini Tsunami',
      author: 'Siti Nurhaliza',
      category: 'Tsunami',
      date: '17 Desember 2025',
    },
    {
      id: 3,
      title: 'Penanggulangan Banjir Berbasis Masyarakat',
      author: 'Budi Santoso',
      category: 'Banjir',
      date: '17 Desember 2025',
    },
  ]);

  const stats = {
    totalDisasters: 8,
    totalArticles: 45,
    totalUsers: 128,
    totalTips: 32,
    pendingReview: pendingArticles.length,
    monthlyViews: 12450
  };

  const handleApprove = (id: number) => {
    alert(`Artikel ID ${id} disetujui`);
  };

  const handleReject = (id: number) => {
    alert(`Artikel ID ${id} ditolak`);
  };

  return (
    <div className="flex min-h-screen bg-gray-50">
      <Sidebar navigateTo={navigateTo} currentPage="dashboard-admin" role="admin" />

      <main className="flex-1 p-8">
        {/* Header */}
        <div className="mb-8">
          <h1 className="text-2xl text-gray-800 mb-2">Dashboard Admin</h1>
          <p className="text-gray-600">Kelola sistem informasi lingkungan dan kesadaran bencana</p>
        </div>

        {/* Stats Cards */}
        <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 mb-8">
          <div className="bg-white rounded-lg border border-gray-200 p-6">
            <div className="flex items-center justify-between mb-2">
              <p className="text-gray-600 text-sm">Jenis Bencana</p>
              <AlertTriangle className="text-orange-500" size={24} />
            </div>
            <p className="text-3xl text-gray-800 mb-1">{stats.totalDisasters}</p>
            <p className="text-xs text-gray-500">Total kategori</p>
          </div>

          <div className="bg-white rounded-lg border border-gray-200 p-6">
            <div className="flex items-center justify-between mb-2">
              <p className="text-gray-600 text-sm">Total Artikel</p>
              <FileText className="text-blue-500" size={24} />
            </div>
            <p className="text-3xl text-gray-800 mb-1">{stats.totalArticles}</p>
            <p className="text-xs text-green-600 inline-flex items-center gap-1">
              <TrendingUp size={12} />
              +5 bulan ini
            </p>
          </div>

          <div className="bg-white rounded-lg border border-gray-200 p-6">
            <div className="flex items-center justify-between mb-2">
              <p className="text-gray-600 text-sm">Total Pengguna</p>
              <Users className="text-green-500" size={24} />
            </div>
            <p className="text-3xl text-gray-800 mb-1">{stats.totalUsers}</p>
            <p className="text-xs text-green-600 inline-flex items-center gap-1">
              <TrendingUp size={12} />
              +12 bulan ini
            </p>
          </div>

          <div className="bg-white rounded-lg border border-gray-200 p-6">
            <div className="flex items-center justify-between mb-2">
              <p className="text-gray-600 text-sm">Tips Pencegahan</p>
              <Lightbulb className="text-yellow-500" size={24} />
            </div>
            <p className="text-3xl text-gray-800 mb-1">{stats.totalTips}</p>
            <p className="text-xs text-gray-500">Total tips</p>
          </div>
        </div>

        {/* Secondary Stats */}
        <div className="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
          <div className="bg-gradient-to-br from-green-500 to-blue-600 rounded-lg p-6 text-white">
            <div className="flex items-center justify-between mb-2">
              <p className="text-white/90 text-sm">Artikel Menunggu Review</p>
              <FileText size={24} />
            </div>
            <p className="text-4xl mb-1">{stats.pendingReview}</p>
            <button
              onClick={() => window.scrollTo({ top: document.body.scrollHeight, behavior: 'smooth' })}
              className="text-sm text-white/90 hover:text-white"
            >
              Lihat semua →
            </button>
          </div>

          <div className="bg-gradient-to-br from-purple-500 to-pink-600 rounded-lg p-6 text-white">
            <div className="flex items-center justify-between mb-2">
              <p className="text-white/90 text-sm">Total Views Bulan Ini</p>
              <Eye size={24} />
            </div>
            <p className="text-4xl mb-1">{stats.monthlyViews.toLocaleString()}</p>
            <p className="text-sm text-white/90">+2,500 dari bulan lalu</p>
          </div>
        </div>

        {/* Quick Actions */}
        <div className="bg-white rounded-lg border border-gray-200 p-6 mb-8">
          <h2 className="text-lg text-gray-800 mb-4">Aksi Cepat</h2>
          <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
            <button
              onClick={() => navigateTo('kelola-bencana')}
              className="p-4 border border-gray-200 rounded-lg hover:border-green-500 hover:bg-green-50 transition-all text-left"
            >
              <AlertTriangle className="text-orange-500 mb-2" size={24} />
              <p className="text-gray-800">Kelola Bencana</p>
              <p className="text-xs text-gray-500 mt-1">Tambah atau edit data bencana</p>
            </button>

            <button className="p-4 border border-gray-200 rounded-lg hover:border-blue-500 hover:bg-blue-50 transition-all text-left">
              <FileText className="text-blue-500 mb-2" size={24} />
              <p className="text-gray-800">Kelola Artikel</p>
              <p className="text-xs text-gray-500 mt-1">Review dan publikasi artikel</p>
            </button>

            <button className="p-4 border border-gray-200 rounded-lg hover:border-green-500 hover:bg-green-50 transition-all text-left">
              <Users className="text-green-500 mb-2" size={24} />
              <p className="text-gray-800">Kelola Pengguna</p>
              <p className="text-xs text-gray-500 mt-1">Manajemen user dan role</p>
            </button>

            <button className="p-4 border border-gray-200 rounded-lg hover:border-yellow-500 hover:bg-yellow-50 transition-all text-left">
              <Lightbulb className="text-yellow-500 mb-2" size={24} />
              <p className="text-gray-800">Kelola Tips</p>
              <p className="text-xs text-gray-500 mt-1">Tambah tips pencegahan</p>
            </button>
          </div>
        </div>

        {/* Pending Articles Table */}
        <div className="bg-white rounded-lg border border-gray-200">
          <div className="p-6 border-b border-gray-200">
            <h2 className="text-lg text-gray-800">Artikel Menunggu Persetujuan</h2>
          </div>

          <div className="overflow-x-auto">
            <table className="w-full">
              <thead className="bg-gray-50 border-b border-gray-200">
                <tr>
                  <th className="px-6 py-3 text-left text-xs text-gray-600 uppercase tracking-wider">
                    Judul
                  </th>
                  <th className="px-6 py-3 text-left text-xs text-gray-600 uppercase tracking-wider">
                    Penulis
                  </th>
                  <th className="px-6 py-3 text-left text-xs text-gray-600 uppercase tracking-wider">
                    Kategori
                  </th>
                  <th className="px-6 py-3 text-left text-xs text-gray-600 uppercase tracking-wider">
                    Tanggal Kirim
                  </th>
                  <th className="px-6 py-3 text-left text-xs text-gray-600 uppercase tracking-wider">
                    Aksi
                  </th>
                </tr>
              </thead>
              <tbody className="divide-y divide-gray-200">
                {pendingArticles.map((article) => (
                  <tr key={article.id} className="hover:bg-gray-50">
                    <td className="px-6 py-4">
                      <p className="text-gray-800">{article.title}</p>
                    </td>
                    <td className="px-6 py-4">
                      <span className="text-sm text-gray-600">{article.author}</span>
                    </td>
                    <td className="px-6 py-4">
                      <span className="px-3 py-1 bg-blue-100 text-blue-700 rounded-full text-xs">
                        {article.category}
                      </span>
                    </td>
                    <td className="px-6 py-4">
                      <span className="text-sm text-gray-600">{article.date}</span>
                    </td>
                    <td className="px-6 py-4">
                      <div className="flex items-center gap-2">
                        <button
                          onClick={() => navigateTo('detail-artikel', { selectedArticleId: article.id })}
                          className="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors"
                          title="Lihat"
                        >
                          <Eye size={18} />
                        </button>
                        <button
                          onClick={() => handleApprove(article.id)}
                          className="p-2 text-green-600 hover:bg-green-50 rounded-lg transition-colors"
                          title="Setujui"
                        >
                          <CheckCircle size={18} />
                        </button>
                        <button
                          onClick={() => handleReject(article.id)}
                          className="p-2 text-red-600 hover:bg-red-50 rounded-lg transition-colors"
                          title="Tolak"
                        >
                          <XCircle size={18} />
                        </button>
                      </div>
                    </td>
                  </tr>
                ))}
              </tbody>
            </table>
          </div>

          {pendingArticles.length === 0 && (
            <div className="p-12 text-center">
              <FileText className="mx-auto text-gray-400 mb-4" size={48} />
              <p className="text-gray-600">Tidak ada artikel yang menunggu persetujuan</p>
            </div>
          )}
        </div>
      </main>
    </div>
  );
}
