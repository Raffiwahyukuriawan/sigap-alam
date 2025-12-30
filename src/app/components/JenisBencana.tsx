import { UserRole } from '../App';
import Navbar from './Navbar';
import Footer from './Footer';
import { AlertTriangle, Droplets, Wind, Flame, Mountain, CloudRain, Waves, Zap, Home, ArrowRight, CheckCircle } from 'lucide-react';
import { motion } from 'motion/react';

interface JenisBencanaProps {
  navigateTo: (page: string) => void;
  userRole: UserRole;
}

export default function JenisBencana({ navigateTo, userRole }: JenisBencanaProps) {
  const disasters = [
    {
      id: 1,
      name: 'Banjir',
      icon: Droplets,
      color: 'from-blue-500 to-cyan-500',
      description: 'Banjir adalah peristiwa tergenangnya daratan oleh air dalam jumlah besar. Pelajari cara pencegahan dan mitigasi banjir.',
      stats: '15 Artikel'
    },
    {
      id: 2,
      name: 'Gempa Bumi',
      icon: AlertTriangle,
      color: 'from-orange-500 to-amber-500',
      description: 'Gempa bumi adalah getaran atau guncangan yang terjadi di permukaan bumi akibat pelepasan energi dari dalam secara tiba-tiba.',
      stats: '12 Artikel'
    },
    {
      id: 3,
      name: 'Tsunami',
      icon: Waves,
      color: 'from-cyan-500 to-blue-600',
      description: 'Tsunami adalah gelombang laut yang sangat besar yang disebabkan oleh gangguan di dasar laut seperti gempa atau letusan gunung api.',
      stats: '8 Artikel'
    },
    {
      id: 4,
      name: 'Kebakaran Hutan',
      icon: Flame,
      color: 'from-red-500 to-orange-500',
      description: 'Kebakaran hutan dan lahan adalah bencana yang merusak ekosistem dan menghasilkan polusi udara berbahaya.',
      stats: '10 Artikel'
    },
    {
      id: 5,
      name: 'Tanah Longsor',
      icon: Mountain,
      color: 'from-amber-600 to-yellow-600',
      description: 'Tanah longsor adalah perpindahan material pembentuk lereng berupa batuan, bahan rombakan, tanah, atau material campuran.',
      stats: '11 Artikel'
    },
    {
      id: 6,
      name: 'Badai dan Angin Topan',
      icon: Wind,
      color: 'from-gray-600 to-slate-600',
      description: 'Badai adalah gangguan atmosfer yang ditandai dengan angin kencang, hujan deras, petir, dan kondisi cuaca ekstrem lainnya.',
      stats: '9 Artikel'
    },
    {
      id: 7,
      name: 'Kekeringan',
      icon: CloudRain,
      color: 'from-yellow-600 to-orange-500',
      description: 'Kekeringan adalah kondisi kekurangan pasokan air dalam waktu yang cukup lama akibat curah hujan di bawah normal.',
      stats: '7 Artikel'
    },
    {
      id: 8,
      name: 'Gunung Meletus',
      icon: Zap,
      color: 'from-purple-500 to-pink-500',
      description: 'Letusan gunung berapi adalah peristiwa keluarnya magma, abu vulkanik, dan gas dari dalam bumi melalui gunung berapi.',
      stats: '13 Artikel'
    },
  ];

  const benefits = [
    'Memahami karakteristik setiap jenis bencana',
    'Mengetahui tindakan pencegahan yang tepat',
    'Siap menghadapi situasi darurat'
  ];

  const containerVariants = {
    hidden: { opacity: 0 },
    visible: {
      opacity: 1,
      transition: {
        staggerChildren: 0.08
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

      {/* Breadcrumb */}
      <div className="bg-white border-b border-gray-200 py-4 shadow-sm">
        <div className="container mx-auto px-4">
          <div className="flex items-center gap-2 text-sm text-gray-600">
            <button 
              onClick={() => navigateTo('landing')}
              className="hover:text-green-600 inline-flex items-center gap-1.5 transition-colors"
            >
              <Home size={16} />
              Beranda
            </button>
            <span>/</span>
            <span className="text-gray-800">Jenis Bencana</span>
          </div>
        </div>
      </div>

      {/* Header - Enhanced */}
      <section className="py-16 md:py-20 bg-gradient-to-br from-green-600 via-emerald-600 to-blue-600 relative overflow-hidden">
        <div className="absolute inset-0 opacity-10">
          <div className="absolute top-0 left-0 w-72 h-72 bg-white rounded-full blur-3xl"></div>
          <div className="absolute bottom-0 right-0 w-72 h-72 bg-white rounded-full blur-3xl"></div>
        </div>

        <div className="container mx-auto px-4 relative z-10">
          <motion.div
            initial={{ opacity: 0, y: 30 }}
            animate={{ opacity: 1, y: 0 }}
            transition={{ duration: 0.6 }}
            className="max-w-3xl mx-auto text-center"
          >
            <span className="inline-block px-4 py-2 bg-white/20 backdrop-blur-sm rounded-full text-white text-sm mb-6">
              📚 Katalog Bencana
            </span>
            <h1 className="text-4xl md:text-5xl mb-6 text-white leading-tight">
              Jenis-Jenis Bencana Alam
            </h1>
            <p className="text-xl text-white/90 leading-relaxed">
              Kenali berbagai jenis bencana alam yang sering terjadi di Indonesia. 
              Pahami karakteristik, dampak, dan cara menghadapi setiap jenis bencana.
            </p>
          </motion.div>
        </div>
      </section>

      {/* Disaster Grid - Enhanced */}
      <section className="py-20 bg-white">
        <div className="container mx-auto px-4">
          <motion.div
            variants={containerVariants}
            initial="hidden"
            whileInView="visible"
            viewport={{ once: true }}
            className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6"
          >
            {disasters.map((disaster) => (
              <motion.div
                key={disaster.id}
                variants={itemVariants}
                whileHover={{ y: -8, transition: { duration: 0.3 } }}
                className="group cursor-pointer"
              >
                <div className="bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all border border-gray-100 h-full">
                  <div className={`bg-gradient-to-br ${disaster.color} p-10 flex items-center justify-center relative overflow-hidden`}>
                    <div className="absolute inset-0 bg-white/10 group-hover:bg-white/20 transition-colors"></div>
                    <disaster.icon className="text-white relative z-10 group-hover:scale-110 transition-transform" size={64} strokeWidth={2} />
                  </div>
                  
                  <div className="p-6">
                    <h3 className="text-xl mb-3 text-gray-800 group-hover:text-green-600 transition-colors">{disaster.name}</h3>
                    <p className="text-gray-600 text-sm mb-4 leading-relaxed">
                      {disaster.description}
                    </p>
                    
                    <div className="flex items-center justify-between pt-4 border-t border-gray-100">
                      <span className="text-xs text-gray-500 inline-flex items-center gap-1">
                        <CheckCircle size={14} className="text-green-500" />
                        {disaster.stats}
                      </span>
                      <button className="text-green-600 text-sm inline-flex items-center gap-1 group-hover:gap-2 transition-all">
                        Detail <ArrowRight size={16} />
                      </button>
                    </div>
                  </div>
                </div>
              </motion.div>
            ))}
          </motion.div>
        </div>
      </section>

      {/* Info Section - Enhanced */}
      <section className="py-20 bg-gradient-to-br from-gray-50 to-blue-50/30">
        <div className="container mx-auto px-4">
          <div className="max-w-5xl mx-auto">
            <motion.div
              initial={{ opacity: 0, y: 30 }}
              whileInView={{ opacity: 1, y: 0 }}
              viewport={{ once: true }}
              transition={{ duration: 0.6 }}
              className="text-center mb-12"
            >
              <h2 className="text-3xl md:text-4xl mb-4 text-gray-800">
                Mengapa Penting Memahami Jenis Bencana?
              </h2>
              <p className="text-lg text-gray-600">
                Pengetahuan adalah kunci kesiapsiagaan
              </p>
            </motion.div>
            
            <div className="grid grid-cols-1 md:grid-cols-3 gap-8">
              {[
                { number: '1', title: 'Kesiapsiagaan', desc: 'Memahami jenis bencana membantu kita lebih siap dan tahu apa yang harus dilakukan saat bencana terjadi.', color: 'from-green-500 to-emerald-500' },
                { number: '2', title: 'Mitigasi', desc: 'Dengan pengetahuan yang tepat, kita dapat melakukan upaya pencegahan dan mengurangi dampak bencana.', color: 'from-blue-500 to-cyan-500' },
                { number: '3', title: 'Keselamatan', desc: 'Pengetahuan tentang bencana dapat menyelamatkan nyawa Anda dan keluarga saat situasi darurat.', color: 'from-green-500 to-blue-500' }
              ].map((item, index) => (
                <motion.div
                  key={index}
                  initial={{ opacity: 0, y: 20 }}
                  whileInView={{ opacity: 1, y: 0 }}
                  viewport={{ once: true }}
                  transition={{ duration: 0.5, delay: index * 0.1 }}
                  className="bg-white p-8 rounded-2xl shadow-lg hover:shadow-xl transition-all border border-gray-100"
                >
                  <div className={`w-14 h-14 bg-gradient-to-br ${item.color} rounded-2xl flex items-center justify-center mb-6 shadow-lg`}>
                    <span className="text-white text-2xl">{item.number}</span>
                  </div>
                  <h3 className="text-xl mb-3 text-gray-800">{item.title}</h3>
                  <p className="text-gray-600 leading-relaxed">
                    {item.desc}
                  </p>
                </motion.div>
              ))}
            </div>
          </div>
        </div>
      </section>

      <Footer />
    </div>
  );
}