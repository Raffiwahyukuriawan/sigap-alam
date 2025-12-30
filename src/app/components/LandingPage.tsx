import { UserRole } from '../App';
import Navbar from './Navbar';
import Footer from './Footer';
import { AlertTriangle, Droplets, Wind, Flame, Mountain, CloudRain, ArrowRight, Calendar, User, BookOpen, Shield, Users2 } from 'lucide-react';
import { motion } from 'motion/react';

interface LandingPageProps {
  navigateTo: (page: string, state?: any) => void;
  userRole: UserRole;
}

export default function LandingPage({ navigateTo, userRole }: LandingPageProps) {
  const disasters = [
    { id: 1, name: 'Banjir', icon: Droplets, color: 'from-blue-500 to-cyan-500', description: 'Informasi dan pencegahan banjir' },
    { id: 2, name: 'Gempa Bumi', icon: AlertTriangle, color: 'from-orange-500 to-amber-500', description: 'Kesiapsiagaan gempa bumi' },
    { id: 3, name: 'Tsunami', icon: Wind, color: 'from-cyan-500 to-blue-600', description: 'Mitigasi dan evakuasi tsunami' },
    { id: 4, name: 'Kebakaran Hutan', icon: Flame, color: 'from-red-500 to-orange-500', description: 'Pencegahan kebakaran hutan' },
    { id: 5, name: 'Longsor', icon: Mountain, color: 'from-amber-600 to-yellow-600', description: 'Antisipasi tanah longsor' },
    { id: 6, name: 'Badai', icon: CloudRain, color: 'from-gray-600 to-slate-600', description: 'Persiapan menghadapi badai' },
  ];

  const articles = [
    {
      id: 1,
      title: 'Cara Menghadapi Banjir di Musim Hujan',
      author: 'Dr. Ahmad Hidayat',
      date: '15 Desember 2025',
      category: 'Banjir',
      excerpt: 'Langkah-langkah penting untuk melindungi keluarga dan properti dari ancaman banjir...',
      image: 'https://images.unsplash.com/photo-1547683905-f686c993aae5?w=800&q=80'
    },
    {
      id: 2,
      title: 'Mitigasi Bencana Gempa Bumi untuk Keluarga',
      author: 'Ir. Siti Nurhaliza',
      date: '12 Desember 2025',
      category: 'Gempa Bumi',
      excerpt: 'Persiapan dan tindakan yang harus dilakukan sebelum, saat, dan setelah gempa bumi...',
      image: 'https://images.unsplash.com/photo-1464207687429-7505649dae38?w=800&q=80'
    },
    {
      id: 3,
      title: 'Pentingnya Reboisasi untuk Cegah Longsor',
      author: 'Prof. Budi Santoso',
      date: '10 Desember 2025',
      category: 'Longsor',
      excerpt: 'Peran vegetasi dan penghijauan dalam mencegah bencana tanah longsor di area rawan...',
      image: 'https://images.unsplash.com/photo-1542601906990-b4d3fb778b09?w=800&q=80'
    },
  ];

  const features = [
    {
      icon: BookOpen,
      title: 'Edukasi Lengkap',
      description: 'Akses informasi lengkap tentang berbagai jenis bencana alam'
    },
    {
      icon: Shield,
      title: 'Mitigasi Bencana',
      description: 'Pelajari cara mencegah dan mengurangi dampak bencana'
    },
    {
      icon: Users2,
      title: 'Komunitas Peduli',
      description: 'Bergabung dengan komunitas yang peduli lingkungan'
    }
  ];

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
        duration: 0.5
      }
    }
  };

  return (
    <div className="min-h-screen bg-gradient-to-br from-gray-50 to-blue-50/30">
      <Navbar navigateTo={navigateTo} userRole={userRole} />

      {/* Hero Section - Enhanced */}
      <section className="relative overflow-hidden bg-gradient-to-br from-green-600 via-emerald-600 to-blue-600 py-20 md:py-32">
        {/* Decorative Elements */}
        <div className="absolute inset-0 opacity-10">
          <div className="absolute top-0 left-0 w-96 h-96 bg-white rounded-full blur-3xl"></div>
          <div className="absolute bottom-0 right-0 w-96 h-96 bg-white rounded-full blur-3xl"></div>
        </div>

        <div className="container mx-auto px-4 relative z-10">
          <div className="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <motion.div
              initial={{ opacity: 0, x: -50 }}
              animate={{ opacity: 1, x: 0 }}
              transition={{ duration: 0.8 }}
            >
              <div className="inline-block px-4 py-2 bg-white/20 backdrop-blur-sm rounded-full text-white text-sm mb-6">
                🌍 Platform Edukasi Bencana Terpercaya
              </div>
              <h1 className="text-4xl md:text-6xl mb-6 text-white leading-tight">
                Bersama Melindungi<br />
                <span className="text-yellow-300">Lingkungan & Kehidupan</span>
              </h1>
              <p className="text-xl text-white/90 mb-8 leading-relaxed">
                SIGAP ALAM membantu masyarakat Indonesia memahami, mencegah, dan menghadapi 
                berbagai jenis bencana alam dengan pengetahuan yang tepat.
              </p>
              <div className="flex flex-wrap gap-4">
                <button 
                  onClick={() => navigateTo('jenis-bencana')}
                  className="px-8 py-4 bg-white text-green-600 rounded-xl hover:bg-gray-50 transition-all shadow-lg hover:shadow-xl hover:scale-105 inline-flex items-center gap-2 group"
                >
                  Mulai Belajar
                  <ArrowRight size={20} className="group-hover:translate-x-1 transition-transform" />
                </button>
                <button 
                  className="px-8 py-4 bg-white/10 backdrop-blur-sm text-white rounded-xl hover:bg-white/20 transition-all border-2 border-white/30"
                >
                  Lihat Artikel
                </button>
              </div>
            </motion.div>

            <motion.div
              initial={{ opacity: 0, x: 50 }}
              animate={{ opacity: 1, x: 0 }}
              transition={{ duration: 0.8, delay: 0.2 }}
              className="hidden lg:block"
            >
              <img
                src="https://images.unsplash.com/photo-1591302299935-2ce91947afc1?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&q=80&w=800"
                alt="Environmental Education"
                className="rounded-3xl shadow-2xl"
              />
            </motion.div>
          </div>
        </div>

        {/* Wave Divider */}
        <div className="absolute bottom-0 left-0 right-0">
          <svg viewBox="0 0 1440 120" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M0 120L60 105C120 90 240 60 360 45C480 30 600 30 720 37.5C840 45 960 60 1080 67.5C1200 75 1320 75 1380 75L1440 75V120H1380C1320 120 1200 120 1080 120C960 120 840 120 720 120C600 120 480 120 360 120C240 120 120 120 60 120H0Z" fill="white"/>
          </svg>
        </div>
      </section>

      {/* Features Section - New */}
      <section className="py-16 bg-white relative -mt-1">
        <div className="container mx-auto px-4">
          <motion.div
            variants={containerVariants}
            initial="hidden"
            whileInView="visible"
            viewport={{ once: true }}
            className="grid grid-cols-1 md:grid-cols-3 gap-8"
          >
            {features.map((feature, index) => (
              <motion.div
                key={index}
                variants={itemVariants}
                className="text-center p-8 rounded-2xl bg-gradient-to-br from-gray-50 to-white border border-gray-100 hover:shadow-xl transition-all hover:-translate-y-2"
              >
                <div className="w-16 h-16 bg-gradient-to-br from-green-500 to-blue-600 rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-lg">
                  <feature.icon className="text-white" size={32} />
                </div>
                <h3 className="text-xl mb-3 text-gray-800">{feature.title}</h3>
                <p className="text-gray-600 leading-relaxed">{feature.description}</p>
              </motion.div>
            ))}
          </motion.div>
        </div>
      </section>

      {/* Disaster Categories - Enhanced */}
      <section className="py-20 bg-white">
        <div className="container mx-auto px-4">
          <motion.div
            initial={{ opacity: 0, y: 30 }}
            whileInView={{ opacity: 1, y: 0 }}
            viewport={{ once: true }}
            transition={{ duration: 0.6 }}
            className="text-center mb-16"
          >
            <span className="inline-block px-4 py-2 bg-green-100 text-green-700 rounded-full text-sm mb-4">
              Kategori Bencana
            </span>
            <h2 className="text-3xl md:text-5xl mb-4 text-gray-800">Jenis Bencana Alam</h2>
            <p className="text-xl text-gray-600 max-w-2xl mx-auto">Pelajari berbagai jenis bencana dan cara menghadapinya</p>
          </motion.div>

          <motion.div
            variants={containerVariants}
            initial="hidden"
            whileInView="visible"
            viewport={{ once: true }}
            className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8"
          >
            {disasters.map((disaster) => (
              <motion.div
                key={disaster.id}
                variants={itemVariants}
                whileHover={{ y: -8, transition: { duration: 0.3 } }}
                className="group cursor-pointer"
                onClick={() => navigateTo('jenis-bencana')}
              >
                <div className="bg-white rounded-2xl p-8 shadow-lg hover:shadow-2xl transition-all border border-gray-100 h-full">
                  <div className={`w-16 h-16 bg-gradient-to-br ${disaster.color} rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform shadow-lg`}>
                    <disaster.icon className="text-white" size={32} strokeWidth={2.5} />
                  </div>
                  <h3 className="text-2xl mb-3 text-gray-800 group-hover:text-green-600 transition-colors">{disaster.name}</h3>
                  <p className="text-gray-600 mb-6 leading-relaxed">{disaster.description}</p>
                  <button className="text-green-600 inline-flex items-center gap-2 group-hover:gap-3 transition-all">
                    Pelajari Lebih Lanjut
                    <ArrowRight size={18} />
                  </button>
                </div>
              </motion.div>
            ))}
          </motion.div>

          <motion.div
            initial={{ opacity: 0 }}
            whileInView={{ opacity: 1 }}
            viewport={{ once: true }}
            className="text-center mt-12"
          >
            <button 
              onClick={() => navigateTo('jenis-bencana')}
              className="text-green-600 hover:text-green-700 inline-flex items-center gap-2 text-lg group"
            >
              Lihat Semua Jenis Bencana
              <ArrowRight size={24} className="group-hover:translate-x-2 transition-transform" />
            </button>
          </motion.div>
        </div>
      </section>

      {/* Latest Articles - Enhanced */}
      <section className="py-20 bg-gradient-to-br from-gray-50 to-blue-50/30">
        <div className="container mx-auto px-4">
          <motion.div
            initial={{ opacity: 0, y: 30 }}
            whileInView={{ opacity: 1, y: 0 }}
            viewport={{ once: true }}
            transition={{ duration: 0.6 }}
            className="text-center mb-16"
          >
            <span className="inline-block px-4 py-2 bg-blue-100 text-blue-700 rounded-full text-sm mb-4">
              Konten Edukasi
            </span>
            <h2 className="text-3xl md:text-5xl mb-4 text-gray-800">Artikel Edukasi Terbaru</h2>
            <p className="text-xl text-gray-600 max-w-2xl mx-auto">Baca artikel dan tips dari para ahli</p>
          </motion.div>

          <motion.div
            variants={containerVariants}
            initial="hidden"
            whileInView="visible"
            viewport={{ once: true }}
            className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8"
          >
            {articles.map((article) => (
              <motion.div
                key={article.id}
                variants={itemVariants}
                whileHover={{ y: -8, transition: { duration: 0.3 } }}
                className="group cursor-pointer"
                onClick={() => navigateTo('detail-artikel', { selectedArticleId: article.id })}
              >
                <div className="bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all h-full">
                  <div className="relative overflow-hidden">
                    <img
                      src={article.image}
                      alt={article.title}
                      className="w-full h-56 object-cover group-hover:scale-110 transition-transform duration-500"
                    />
                    <div className="absolute top-4 left-4">
                      <span className="px-4 py-2 bg-white/95 backdrop-blur-sm text-green-700 rounded-full text-sm shadow-lg">
                        {article.category}
                      </span>
                    </div>
                  </div>
                  <div className="p-6">
                    <h3 className="text-xl mb-3 text-gray-800 leading-snug group-hover:text-green-600 transition-colors">{article.title}</h3>
                    <p className="text-gray-600 mb-4 leading-relaxed line-clamp-2">{article.excerpt}</p>
                    
                    <div className="flex items-center gap-4 text-sm text-gray-500 mb-4 pb-4 border-b border-gray-100">
                      <span className="inline-flex items-center gap-1.5">
                        <User size={16} />
                        {article.author}
                      </span>
                      <span className="inline-flex items-center gap-1.5">
                        <Calendar size={16} />
                        {article.date}
                      </span>
                    </div>

                    <button className="text-green-600 inline-flex items-center gap-2 group-hover:gap-3 transition-all">
                      Baca Selengkapnya
                      <ArrowRight size={18} />
                    </button>
                  </div>
                </div>
              </motion.div>
            ))}
          </motion.div>

          <motion.div
            initial={{ opacity: 0 }}
            whileInView={{ opacity: 1 }}
            viewport={{ once: true }}
            className="text-center mt-12"
          >
            <button className="text-blue-600 hover:text-blue-700 inline-flex items-center gap-2 text-lg group">
              Lihat Semua Artikel
              <ArrowRight size={24} className="group-hover:translate-x-2 transition-transform" />
            </button>
          </motion.div>
        </div>
      </section>

      {/* CTA Section - Enhanced */}
      <section className="py-20 bg-gradient-to-br from-green-600 via-emerald-600 to-blue-600 relative overflow-hidden">
        <div className="absolute inset-0 opacity-10">
          <div className="absolute top-0 right-0 w-96 h-96 bg-white rounded-full blur-3xl"></div>
          <div className="absolute bottom-0 left-0 w-96 h-96 bg-white rounded-full blur-3xl"></div>
        </div>

        <motion.div
          initial={{ opacity: 0, scale: 0.95 }}
          whileInView={{ opacity: 1, scale: 1 }}
          viewport={{ once: true }}
          transition={{ duration: 0.6 }}
          className="container mx-auto px-4 text-center relative z-10"
        >
          <h2 className="text-3xl md:text-5xl mb-6 text-white">
            Ingin Berkontribusi?
          </h2>
          <p className="text-xl text-white/90 mb-8 max-w-2xl mx-auto leading-relaxed">
            Bergabunglah sebagai kontributor dan bagikan pengetahuan Anda untuk 
            membantu masyarakat lebih siap menghadapi bencana.
          </p>
          <button className="px-10 py-4 bg-white text-green-600 rounded-xl hover:bg-gray-50 transition-all shadow-xl hover:shadow-2xl hover:scale-105">
            Daftar Sebagai Kontributor
          </button>
        </motion.div>
      </section>

      <Footer />
    </div>
  );
}