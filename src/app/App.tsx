import { useState } from 'react';
import LandingPage from './components/LandingPage';
import JenisBencana from './components/JenisBencana';
import DetailArtikel from './components/DetailArtikel';
import DashboardKontributor from './components/DashboardKontributor';
import FormArtikel from './components/FormArtikel';
import DashboardAdmin from './components/DashboardAdmin';
import KelolaBencana from './components/KelolaBencana';

export type UserRole = 'guest' | 'contributor' | 'admin';

export interface AppState {
  currentPage: string;
  userRole: UserRole;
  selectedArticleId?: number;
  selectedDisasterId?: number;
  editArticleId?: number;
  editDisasterId?: number;
}

function App() {
  const [appState, setAppState] = useState<AppState>({
    currentPage: 'landing',
    userRole: 'guest'
  });

  const navigateTo = (page: string, additionalState?: Partial<AppState>) => {
    setAppState(prev => ({ ...prev, currentPage: page, ...additionalState }));
  };

  const renderPage = () => {
    switch (appState.currentPage) {
      case 'landing':
        return <LandingPage navigateTo={navigateTo} userRole={appState.userRole} />;
      case 'jenis-bencana':
        return <JenisBencana navigateTo={navigateTo} userRole={appState.userRole} />;
      case 'detail-artikel':
        return <DetailArtikel navigateTo={navigateTo} userRole={appState.userRole} articleId={appState.selectedArticleId} />;
      case 'dashboard-kontributor':
        return <DashboardKontributor navigateTo={navigateTo} editArticleId={appState.editArticleId} />;
      case 'form-artikel':
        return <FormArtikel navigateTo={navigateTo} editId={appState.editArticleId} />;
      case 'dashboard-admin':
        return <DashboardAdmin navigateTo={navigateTo} />;
      case 'kelola-bencana':
        return <KelolaBencana navigateTo={navigateTo} />;
      default:
        return <LandingPage navigateTo={navigateTo} userRole={appState.userRole} />;
    }
  };

  return (
    <div className="min-h-screen bg-gray-50">
      {/* Role Switcher - untuk demo saja */}
      <div className="fixed top-4 right-4 z-50 bg-white shadow-lg rounded-lg p-3 border border-gray-200">
        <p className="text-xs mb-2">Demo Role:</p>
        <div className="flex gap-2">
          <button
            onClick={() => setAppState(prev => ({ ...prev, userRole: 'guest', currentPage: 'landing' }))}
            className={`px-3 py-1 rounded text-xs ${appState.userRole === 'guest' ? 'bg-blue-600 text-white' : 'bg-gray-200'}`}
          >
            User
          </button>
          <button
            onClick={() => setAppState(prev => ({ ...prev, userRole: 'contributor', currentPage: 'dashboard-kontributor' }))}
            className={`px-3 py-1 rounded text-xs ${appState.userRole === 'contributor' ? 'bg-green-600 text-white' : 'bg-gray-200'}`}
          >
            Kontributor
          </button>
          <button
            onClick={() => setAppState(prev => ({ ...prev, userRole: 'admin', currentPage: 'dashboard-admin' }))}
            className={`px-3 py-1 rounded text-xs ${appState.userRole === 'admin' ? 'bg-emerald-600 text-white' : 'bg-gray-200'}`}
          >
            Admin
          </button>
        </div>
      </div>

      {renderPage()}
    </div>
  );
}

export default App;
