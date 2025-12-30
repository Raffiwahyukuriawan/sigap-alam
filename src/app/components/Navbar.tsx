import { UserRole } from '../App';
import { Menu, X } from 'lucide-react';
import { useState } from 'react';

interface NavbarProps {
  navigateTo: (page: string) => void;
  userRole: UserRole;
}

export default function Navbar({ navigateTo, userRole }: NavbarProps) {
  const [mobileMenuOpen, setMobileMenuOpen] = useState(false);

  return (
    <nav className="bg-white shadow-sm border-b border-gray-200">
      <div className="container mx-auto px-4">
        <div className="flex items-center justify-between h-16">
          {/* Logo */}
          <div 
            className="flex items-center gap-3 cursor-pointer"
            onClick={() => navigateTo('landing')}
          >
            <div className="w-10 h-10 bg-gradient-to-br from-green-500 to-blue-600 rounded-lg flex items-center justify-center">
              <span className="text-white font-bold">SA</span>
            </div>
            <span className="font-bold text-lg text-gray-800">SIGAP ALAM</span>
          </div>

          {/* Desktop Menu */}
          <div className="hidden md:flex items-center gap-6">
            <button
              onClick={() => navigateTo('landing')}
              className="text-gray-600 hover:text-green-600 transition-colors"
            >
              Beranda
            </button>
            <button
              onClick={() => navigateTo('jenis-bencana')}
              className="text-gray-600 hover:text-green-600 transition-colors"
            >
              Jenis Bencana
            </button>
            <button
              onClick={() => navigateTo('landing')}
              className="text-gray-600 hover:text-green-600 transition-colors"
            >
              Artikel Edukasi
            </button>
            <button
              onClick={() => navigateTo('landing')}
              className="text-gray-600 hover:text-green-600 transition-colors"
            >
              Tips Pencegahan
            </button>
            
            {userRole === 'guest' && (
              <button className="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors">
                Login
              </button>
            )}
          </div>

          {/* Mobile Menu Button */}
          <button
            className="md:hidden text-gray-600"
            onClick={() => setMobileMenuOpen(!mobileMenuOpen)}
          >
            {mobileMenuOpen ? <X size={24} /> : <Menu size={24} />}
          </button>
        </div>

        {/* Mobile Menu */}
        {mobileMenuOpen && (
          <div className="md:hidden py-4 border-t border-gray-200">
            <div className="flex flex-col gap-3">
              <button
                onClick={() => {
                  navigateTo('landing');
                  setMobileMenuOpen(false);
                }}
                className="text-gray-600 hover:text-green-600 text-left py-2"
              >
                Beranda
              </button>
              <button
                onClick={() => {
                  navigateTo('jenis-bencana');
                  setMobileMenuOpen(false);
                }}
                className="text-gray-600 hover:text-green-600 text-left py-2"
              >
                Jenis Bencana
              </button>
              <button
                onClick={() => {
                  navigateTo('landing');
                  setMobileMenuOpen(false);
                }}
                className="text-gray-600 hover:text-green-600 text-left py-2"
              >
                Artikel Edukasi
              </button>
              <button
                onClick={() => {
                  navigateTo('landing');
                  setMobileMenuOpen(false);
                }}
                className="text-gray-600 hover:text-green-600 text-left py-2"
              >
                Tips Pencegahan
              </button>
              {userRole === 'guest' && (
                <button className="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 mt-2">
                  Login
                </button>
              )}
            </div>
          </div>
        )}
      </div>
    </nav>
  );
}
