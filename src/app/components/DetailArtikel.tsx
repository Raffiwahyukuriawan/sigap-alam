import { UserRole } from '../App';
import Navbar from './Navbar';
import Footer from './Footer';
import { Home, Calendar, User, Tag, ArrowLeft, MessageSquare, Send } from 'lucide-react';
import { useState } from 'react';

interface DetailArtikelProps {
  navigateTo: (page: string) => void;
  userRole: UserRole;
  articleId?: number;
}

export default function DetailArtikel({ navigateTo, userRole, articleId = 1 }: DetailArtikelProps) {
  const [comment, setComment] = useState('');
  const [comments, setComments] = useState([
    {
      id: 1,
      author: 'Budi Setiawan',
      date: '16 Desember 2025',
      content: 'Artikel yang sangat bermanfaat! Terima kasih atas informasinya.'
    },
    {
      id: 2,
      author: 'Siti Rahayu',
      date: '16 Desember 2025',
      content: 'Sangat edukatif. Saya jadi lebih paham cara menghadapi banjir.'
    }
  ]);

  const article = {
    id: articleId,
    title: 'Cara Menghadapi Banjir di Musim Hujan',
    author: 'Dr. Ahmad Hidayat',
    authorTitle: 'Ahli Meteorologi & Klimatologi',
    date: '15 Desember 2025',
    category: 'Banjir',
    readTime: '5 menit',
    image: 'https://images.unsplash.com/photo-1547683905-f686c993aae5?w=1200&q=80',
    content: `
      <p>Banjir merupakan salah satu bencana alam yang paling sering terjadi di Indonesia, terutama saat musim hujan. Mengetahui cara menghadapi banjir dengan tepat dapat menyelamatkan nyawa dan mengurangi kerugian material.</p>

      <h2>Persiapan Sebelum Banjir</h2>
      <p>Langkah-langkah yang dapat dilakukan sebelum banjir terjadi:</p>
      <ul>
        <li>Kenali area rawan banjir di sekitar tempat tinggal Anda</li>
        <li>Siapkan tas darurat berisi dokumen penting, obat-obatan, makanan, dan air</li>
        <li>Buat rencana evakuasi bersama keluarga</li>
        <li>Simpan barang berharga di tempat yang lebih tinggi</li>
        <li>Pastikan sistem drainase rumah berfungsi dengan baik</li>
      </ul>

      <h2>Saat Banjir Terjadi</h2>
      <p>Tindakan yang harus dilakukan ketika banjir melanda:</p>
      <ul>
        <li>Tetap tenang dan jangan panik</li>
        <li>Matikan listrik dan gas untuk menghindari bahaya</li>
        <li>Pindah ke tempat yang lebih tinggi segera</li>
        <li>Jangan mencoba melewati arus air yang deras</li>
        <li>Ikuti instruksi dari petugas atau relawan bencana</li>
        <li>Jauhi area yang berpotensi longsor</li>
      </ul>

      <h2>Setelah Banjir Surut</h2>
      <p>Langkah pemulihan pasca banjir:</p>
      <ul>
        <li>Periksa kondisi rumah sebelum masuk kembali</li>
        <li>Bersihkan dan desinfeksi area yang terkena banjir</li>
        <li>Buang makanan yang sudah terendam air</li>
        <li>Dokumentasikan kerusakan untuk klaim asuransi</li>
        <li>Waspada terhadap penyakit yang mungkin muncul pasca banjir</li>
      </ul>

      <h2>Kesimpulan</h2>
      <p>Kesiapsiagaan adalah kunci utama dalam menghadapi bencana banjir. Dengan memahami langkah-langkah pencegahan dan penanganan yang tepat, kita dapat mengurangi risiko dan dampak negatif dari bencana banjir. Selalu update informasi cuaca dan peringatan dini dari BMKG dan pihak berwenang setempat.</p>
    `
  };

  const handleSubmitComment = (e: React.FormEvent) => {
    e.preventDefault();
    if (comment.trim()) {
      setComments([
        ...comments,
        {
          id: comments.length + 1,
          author: 'Anda',
          date: new Date().toLocaleDateString('id-ID', { day: 'numeric', month: 'long', year: 'numeric' }),
          content: comment
        }
      ]);
      setComment('');
    }
  };

  return (
    <div className="min-h-screen bg-white">
      <Navbar navigateTo={navigateTo} userRole={userRole} />

      {/* Breadcrumb */}
      <div className="bg-gray-50 border-b border-gray-200 py-3">
        <div className="container mx-auto px-4">
          <div className="flex items-center gap-2 text-sm text-gray-600">
            <button 
              onClick={() => navigateTo('landing')}
              className="hover:text-green-600 inline-flex items-center gap-1"
            >
              <Home size={16} />
              Beranda
            </button>
            <span>/</span>
            <button 
              onClick={() => navigateTo('landing')}
              className="hover:text-green-600"
            >
              Artikel
            </button>
            <span>/</span>
            <span className="text-gray-800">Detail</span>
          </div>
        </div>
      </div>

      {/* Back Button */}
      <div className="container mx-auto px-4 py-6">
        <button
          onClick={() => navigateTo('landing')}
          className="inline-flex items-center gap-2 text-gray-600 hover:text-green-600 transition-colors"
        >
          <ArrowLeft size={20} />
          Kembali ke Artikel
        </button>
      </div>

      {/* Article Header */}
      <article className="pb-16">
        <div className="container mx-auto px-4">
          <div className="max-w-4xl mx-auto">
            {/* Category Badge */}
            <span className="inline-block px-4 py-1 bg-green-100 text-green-700 rounded-full text-sm mb-4">
              {article.category}
            </span>

            {/* Title */}
            <h1 className="text-3xl md:text-4xl mb-6 text-gray-800 leading-tight">
              {article.title}
            </h1>

            {/* Meta Info */}
            <div className="flex flex-wrap items-center gap-4 text-sm text-gray-600 mb-6 pb-6 border-b border-gray-200">
              <div className="inline-flex items-center gap-2">
                <User size={18} />
                <span>{article.author}</span>
              </div>
              <div className="inline-flex items-center gap-2">
                <Calendar size={18} />
                <span>{article.date}</span>
              </div>
              <div className="inline-flex items-center gap-2">
                <Tag size={18} />
                <span>{article.readTime} baca</span>
              </div>
            </div>

            {/* Author Card */}
            <div className="bg-gray-50 border border-gray-200 rounded-lg p-4 mb-8 flex items-center gap-4">
              <div className="w-16 h-16 bg-gradient-to-br from-green-500 to-blue-600 rounded-full flex items-center justify-center text-white text-xl">
                {article.author.charAt(0)}
              </div>
              <div>
                <p className="text-gray-800">{article.author}</p>
                <p className="text-sm text-gray-600">{article.authorTitle}</p>
              </div>
            </div>

            {/* Featured Image */}
            <img
              src={article.image}
              alt={article.title}
              className="w-full h-96 object-cover rounded-lg mb-8"
            />

            {/* Article Content */}
            <div 
              className="prose prose-lg max-w-none"
              dangerouslySetInnerHTML={{ __html: article.content }}
              style={{
                lineHeight: '1.8'
              }}
            />
          </div>
        </div>
      </article>

      {/* Comments Section */}
      <section className="py-16 bg-gray-50">
        <div className="container mx-auto px-4">
          <div className="max-w-4xl mx-auto">
            <h2 className="text-2xl mb-6 text-gray-800 inline-flex items-center gap-2">
              <MessageSquare size={28} />
              Komentar ({comments.length})
            </h2>

            {/* Comment Form */}
            <form onSubmit={handleSubmitComment} className="bg-white border border-gray-200 rounded-lg p-6 mb-6">
              <textarea
                value={comment}
                onChange={(e) => setComment(e.target.value)}
                placeholder="Tulis komentar Anda..."
                rows={4}
                className="w-full border border-gray-300 rounded-lg p-3 text-gray-800 focus:outline-none focus:ring-2 focus:ring-green-500 mb-3"
              />
              <button
                type="submit"
                className="px-6 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors inline-flex items-center gap-2"
              >
                <Send size={18} />
                Kirim Komentar
              </button>
            </form>

            {/* Comments List */}
            <div className="space-y-4">
              {comments.map((c) => (
                <div key={c.id} className="bg-white border border-gray-200 rounded-lg p-6">
                  <div className="flex items-start gap-4">
                    <div className="w-10 h-10 bg-gradient-to-br from-blue-500 to-green-500 rounded-full flex items-center justify-center text-white flex-shrink-0">
                      {c.author.charAt(0)}
                    </div>
                    <div className="flex-1">
                      <div className="flex items-center gap-3 mb-2">
                        <span className="text-gray-800">{c.author}</span>
                        <span className="text-sm text-gray-500">{c.date}</span>
                      </div>
                      <p className="text-gray-600">{c.content}</p>
                    </div>
                  </div>
                </div>
              ))}
            </div>
          </div>
        </div>
      </section>

      <Footer />
    </div>
  );
}
