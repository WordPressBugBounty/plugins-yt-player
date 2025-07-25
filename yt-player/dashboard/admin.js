import { createRoot } from 'react-dom/client';
import AppContainer from './Index';
import './admin.scss';
document.addEventListener('DOMContentLoaded', () => {
  const adminEl = document.getElementById('ytplYtPlayerDashboard');
  const isPremium = adminEl.dataset.ispremium === '1' ? true : false;

  
  createRoot(adminEl).render(<AppContainer isPremium={isPremium} />);
  adminEl.removeAttribute('data-ispremium'); // Clean up the attribute after use
});