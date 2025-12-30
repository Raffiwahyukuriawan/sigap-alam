import { LayoutDashboard, FileText, PenSquare, User, LogOut, AlertTriangle, Users, Lightbulb } from 'lucide-react';

interface SidebarProps {
  navigateTo: (page: string, state?: any) => void;
  currentPage: string;
  role: 'contributor' | 'admin';
}

export default function Sidebar({ navigateTo, currentPage, role }: SidebarProps) {
  const contributorMenu = [
    { id: 'dashboard-kontributor', label: 'Dashboard', icon: LayoutDashboard },
    { id: 'dashboard-kontributor', label: 'Artikel Saya', icon: FileText },
    { id: 'form-artikel', label: 'Buat Artikel', icon: PenSquare },
    { id: 'profile', label: 'Profil', icon: User },
  ];

  const adminMenu = [
    { id: 'dashboard-admin', label: 'Dashboard', icon: LayoutDashboard },
    { id: 'kelola-bencana', label: 'Kelola Bencana', icon: AlertTriangle },
    { id: 'dashboard-admin', label: 'Artikel', icon: FileText },
    { id: 'dashboard-admin', label: 'Tips Pencegahan', icon: Lightbulb },
    { id: 'dashboard-admin', label: 'Pengguna', icon: Users },
  ];

  const menuItems = role === 'contributor' ? contributorMenu : adminMenu;

  return (
    <aside className="w-64 bg-white border-r border-gray-200 min-h-screen flex flex-col shadow-lg">
      {/* Logo */}
      <div className="p-6 border-b border-gray-200">
        <div className="flex items-center gap-3">
          <div className="w-10 h-10 bg-gradient-to-br from-green-500 to-blue-600 rounded-xl flex items-center justify-center shadow-lg">
            <span className="text-white font-bold text-sm">SA</span>
          </div>
          <div>
            <p className="font-bold text-gray-800">SIGAP ALAM</p>
            <p className="text-xs text-gray-500 capitalize">{role}</p>
          </div>
        </div>
      </div>

      {/* Menu Items */}
      <nav className="flex-1 p-4">
        <ul className="space-y-2">
          {menuItems.map((item) => (
            <li key={item.id}>
              <button
                onClick={() => navigateTo(item.id)}
                className={`relative w-full flex items-center gap-3 px-4 py-3 rounded-xl transition-all ${
                  currentPage === item.id
                    ? 'bg-gradient-to-r from-green-500 to-emerald-500 text-white shadow-lg shadow-green-500/30'
                    : 'text-gray-600 hover:bg-gradient-to-r hover:from-gray-50 hover:to-blue-50/50'
                }`}
              >
                {currentPage === item.id && (
                  <div className="absolute left-0 top-1/2 -translate-y-1/2 w-1 h-8 bg-white rounded-r-full"></div>
                )}
                <item.icon size={20} strokeWidth={currentPage === item.id ? 2.5 : 2} />
                <span className={currentPage === item.id ? 'font-semibold' : ''}>{item.label}</span>
              </button>
            </li>
          ))}
        </ul>
      </nav>

      {/* Logout */}
      <div className="p-4 border-t border-gray-200">
        <button
          onClick={() => navigateTo('landing')}
          className="w-full flex items-center gap-3 px-4 py-3 rounded-xl text-red-600 hover:bg-red-50 transition-all"
        >
          <LogOut size={20} />
          <span>Logout</span>
        </button>
      </div>
    </aside>
  );
}