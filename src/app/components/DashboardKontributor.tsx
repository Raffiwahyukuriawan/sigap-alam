import Sidebar from './Sidebar';
import { FileText, Eye, Edit, Trash2, Clock, CheckCircle, XCircle, TrendingUp } from 'lucide-react';
import { useState } from 'react';
import { motion } from 'motion/react';

interface DashboardKontributorProps {
  navigateTo: (page: string, state?: any) => void;
  editArticleId?: number;
}

export default function DashboardKontributor({ navigateTo }: DashboardKontributorProps) {
  const [articles] = useState([
    {
      id: 1,
      title: 'Cara Menghadapi Banjir di Musim Hujan',
      category: 'Banjir',
      status: 'published',
      date: '15 Desember 2025',
      views: 1245
    },
    {
      id: 2,
      title: 'Langkah Evakuasi Saat Gempa Bumi',
      category: 'Gempa Bumi',
      status: 'pending',
      date: '14 Desember 2025',
      views: 0
    },
    {
      id: 3,
      title: 'Tips Mencegah Kebakaran Hutan',
      category: 'Kebakaran Hutan',
      status: 'draft',
      date: '13 Desember 2025',
      views: 0
    },
  ]);

  const stats = {
    total: articles.length,
    published: articles.filter(a => a.status === 'published').length,
    pending: articles.filter(a => a.status === 'pending').length,
    draft: articles.filter(a => a.status === 'draft').length
  };

  const getStatusBadge = (status: string) => {
    switch (status) {
      case 'published':
        return (
          <span className="inline-flex items-center gap-1 px-3 py-1 bg-green-100 text-green-700 rounded-full text-xs">
            <CheckCircle size={14} />
            Published
          </span>
        );
      case 'pending':
        return (
          <span className="inline-flex items-center gap-1 px-3 py-1 bg-yellow-100 text-yellow-700 rounded-full text-xs">
            <Clock size={14} />
            Pending
          </span>
        );
      case 'draft':
        return (
          <span className="inline-flex items-center gap-1 px-3 py-1 bg-gray-100 text-gray-700 rounded-full text-xs">
            <XCircle size={14} />
            Draft
          </span>
        );
      default:
        return null;
    }
  };

  const containerVariants = {
    hidden: { opacity: 0 },
    visible: {
      opacity: 1,
      transition: {
        staggerChildren: 0.1
      }
    }
  };

  const itemVariants = {
    hidden: { opacity: 0, y: 20 },
    visible: {
      opacity: 1,
      y: 0,
      transition: {
        duration: 0.4
      }
    }
  };

  return (
    <div className="flex min-h-screen bg-gradient-to-br from-gray-50 to-blue-50/20">
      <Sidebar navigateTo={navigateTo} currentPage="dashboard-kontributor" role="contributor" />

      <main className="flex-1 p-8">
        {/* Header */}
        <motion.div
          initial={{ opacity: 0, y: -20 }}
          animate={{ opacity: 1, y: 0 }}
          transition={{ duration: 0.5 }}
          className="mb-8"
        >
          <h1 className="text-3xl text-gray-800 mb-2">Dashboard Kontributor</h1>
          <p className="text-gray-600">Kelola artikel edukasi Anda</p>
        </motion.div>

        {/* Stats Cards - Enhanced */}
        <motion.div
          variants={containerVariants}
          initial="hidden"
          animate="visible"
          className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8"
        >
          <motion.div variants={itemVariants} className="bg-white rounded-2xl border border-gray-200 p-6 hover:shadow-xl transition-all">
            <div className="flex items-center justify-between mb-4">
              <div className="w-12 h-12 bg-gradient-to-br from-blue-500 to-cyan-500 rounded-xl flex items-center justify-center shadow-lg">
                <FileText className="text-white" size={24} />
              </div>
              <div className="text-right">
                <p className="text-gray-600 text-sm">Total Artikel</p>
                <p className="text-3xl text-gray-800">{stats.total}</p>
              </div>
            </div>
            <div className="flex items-center text-green-600 text-sm">
              <TrendingUp size={16} className="mr-1" />
              <span>Aktif menulis</span>
            </div>
          </motion.div>

          <motion.div variants={itemVariants} className="bg-white rounded-2xl border border-gray-200 p-6 hover:shadow-xl transition-all">
            <div className="flex items-center justify-between mb-4">
              <div className="w-12 h-12 bg-gradient-to-br from-green-500 to-emerald-500 rounded-xl flex items-center justify-center shadow-lg">
                <CheckCircle className="text-white" size={24} />
              </div>
              <div className="text-right">
                <p className="text-gray-600 text-sm">Published</p>
                <p className="text-3xl text-gray-800">{stats.published}</p>
              </div>
            </div>
            <div className="flex items-center text-green-600 text-sm">
              <TrendingUp size={16} className="mr-1" />
              <span>Diterbitkan</span>
            </div>
          </motion.div>

          <motion.div variants={itemVariants} className="bg-white rounded-2xl border border-gray-200 p-6 hover:shadow-xl transition-all">
            <div className="flex items-center justify-between mb-4">
              <div className="w-12 h-12 bg-gradient-to-br from-yellow-500 to-orange-500 rounded-xl flex items-center justify-center shadow-lg">
                <Clock className="text-white" size={24} />
              </div>
              <div className="text-right">
                <p className="text-gray-600 text-sm">Pending</p>
                <p className="text-3xl text-gray-800">{stats.pending}</p>
              </div>
            </div>
            <div className="flex items-center text-yellow-600 text-sm">
              <Clock size={16} className="mr-1" />
              <span>Menunggu review</span>
            </div>
          </motion.div>

          <motion.div variants={itemVariants} className="bg-white rounded-2xl border border-gray-200 p-6 hover:shadow-xl transition-all">
            <div className="flex items-center justify-between mb-4">
              <div className="w-12 h-12 bg-gradient-to-br from-gray-500 to-slate-600 rounded-xl flex items-center justify-center shadow-lg">
                <XCircle className="text-white" size={24} />
              </div>
              <div className="text-right">
                <p className="text-gray-600 text-sm">Draft</p>
                <p className="text-3xl text-gray-800">{stats.draft}</p>
              </div>
            </div>
            <div className="flex items-center text-gray-600 text-sm">
              <FileText size={16} className="mr-1" />
              <span>Belum selesai</span>
            </div>
          </motion.div>
        </motion.div>

        {/* Articles Table - Enhanced */}
        <motion.div
          initial={{ opacity: 0, y: 20 }}
          animate={{ opacity: 1, y: 0 }}
          transition={{ duration: 0.5, delay: 0.3 }}
          className="bg-white rounded-2xl border border-gray-200 shadow-lg"
        >
          <div className="p-6 border-b border-gray-200 flex items-center justify-between">
            <h2 className="text-xl text-gray-800">Artikel Saya</h2>
            <button
              onClick={() => navigateTo('form-artikel')}
              className="px-6 py-3 bg-gradient-to-r from-green-600 to-emerald-600 text-white rounded-xl hover:shadow-lg transition-all hover:scale-105"
            >
              Buat Artikel Baru
            </button>
          </div>

          <div className="overflow-x-auto">
            <table className="w-full">
              <thead className="bg-gradient-to-r from-gray-50 to-blue-50/50 border-b border-gray-200">
                <tr>
                  <th className="px-6 py-4 text-left text-xs text-gray-600 uppercase tracking-wider">
                    Judul
                  </th>
                  <th className="px-6 py-4 text-left text-xs text-gray-600 uppercase tracking-wider">
                    Kategori
                  </th>
                  <th className="px-6 py-4 text-left text-xs text-gray-600 uppercase tracking-wider">
                    Status
                  </th>
                  <th className="px-6 py-4 text-left text-xs text-gray-600 uppercase tracking-wider">
                    Tanggal
                  </th>
                  <th className="px-6 py-4 text-left text-xs text-gray-600 uppercase tracking-wider">
                    Views
                  </th>
                  <th className="px-6 py-4 text-left text-xs text-gray-600 uppercase tracking-wider">
                    Aksi
                  </th>
                </tr>
              </thead>
              <tbody className="divide-y divide-gray-100">
                {articles.map((article, index) => (
                  <motion.tr
                    key={article.id}
                    initial={{ opacity: 0, x: -20 }}
                    animate={{ opacity: 1, x: 0 }}
                    transition={{ duration: 0.3, delay: index * 0.1 }}
                    className="hover:bg-gradient-to-r hover:from-gray-50 hover:to-blue-50/30 transition-all"
                  >
                    <td className="px-6 py-4">
                      <p className="text-gray-800">{article.title}</p>
                    </td>
                    <td className="px-6 py-4">
                      <span className="text-sm text-gray-600">{article.category}</span>
                    </td>
                    <td className="px-6 py-4">
                      {getStatusBadge(article.status)}
                    </td>
                    <td className="px-6 py-4">
                      <span className="text-sm text-gray-600">{article.date}</span>
                    </td>
                    <td className="px-6 py-4">
                      <span className="text-sm text-gray-600">{article.views}</span>
                    </td>
                    <td className="px-6 py-4">
                      <div className="flex items-center gap-2">
                        <button
                          onClick={() => navigateTo('detail-artikel', { selectedArticleId: article.id })}
                          className="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-all hover:scale-110"
                          title="Lihat"
                        >
                          <Eye size={18} />
                        </button>
                        <button
                          onClick={() => navigateTo('form-artikel', { editArticleId: article.id })}
                          className="p-2 text-green-600 hover:bg-green-50 rounded-lg transition-all hover:scale-110"
                          title="Edit"
                        >
                          <Edit size={18} />
                        </button>
                        <button
                          className="p-2 text-red-600 hover:bg-red-50 rounded-lg transition-all hover:scale-110"
                          title="Hapus"
                        >
                          <Trash2 size={18} />
                        </button>
                      </div>
                    </td>
                  </motion.tr>
                ))}
              </tbody>
            </table>
          </div>

          {articles.length === 0 && (
            <div className="p-12 text-center">
              <FileText className="mx-auto text-gray-400 mb-4" size={48} />
              <p className="text-gray-600 mb-4">Belum ada artikel</p>
              <button
                onClick={() => navigateTo('form-artikel')}
                className="px-6 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors"
              >
                Buat Artikel Pertama
              </button>
            </div>
          )}
        </motion.div>
      </main>
    </div>
  );
}