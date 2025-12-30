export default function Footer() {
  return (
    <footer className="bg-gray-800 text-white mt-16">
      <div className="container mx-auto px-4 py-8">
        <div className="grid grid-cols-1 md:grid-cols-3 gap-8">
          {/* About */}
          <div>
            <div className="flex items-center gap-3 mb-4">
              <div className="w-10 h-10 bg-gradient-to-br from-green-500 to-blue-600 rounded-lg flex items-center justify-center">
                <span className="text-white font-bold">SA</span>
              </div>
              <span className="font-bold">SIGAP ALAM</span>
            </div>
            <p className="text-gray-300 text-sm leading-relaxed">
              Sistem Informasi Edukasi Lingkungan dan Kesadaran Bencana untuk meningkatkan 
              kesiapsiagaan masyarakat Indonesia dalam menghadapi berbagai jenis bencana alam.
            </p>
          </div>

          {/* Quick Links */}
          <div>
            <h3 className="font-semibold mb-4">Menu</h3>
            <ul className="space-y-2 text-sm">
              <li><a href="#" className="text-gray-300 hover:text-green-400 transition-colors">Beranda</a></li>
              <li><a href="#" className="text-gray-300 hover:text-green-400 transition-colors">Jenis Bencana</a></li>
              <li><a href="#" className="text-gray-300 hover:text-green-400 transition-colors">Artikel Edukasi</a></li>
              <li><a href="#" className="text-gray-300 hover:text-green-400 transition-colors">Tips Pencegahan</a></li>
            </ul>
          </div>

          {/* Contact */}
          <div>
            <h3 className="font-semibold mb-4">Kontak</h3>
            <ul className="space-y-2 text-sm text-gray-300">
              <li>Email: info@sigapalam.id</li>
              <li>Telp: (021) 1234-5678</li>
              <li>Alamat: Jakarta, Indonesia</li>
            </ul>
          </div>
        </div>

        <div className="border-t border-gray-700 mt-8 pt-6 text-center text-sm text-gray-400">
          <p>&copy; 2025 SIGAP ALAM. Semua hak dilindungi.</p>
        </div>
      </div>
    </footer>
  );
}
