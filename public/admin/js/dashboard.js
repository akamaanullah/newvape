/**
 * New Vape - Admin Dashboard JavaScript
 * Handles dashboard KPI interactions, time range selectors, and analytics hooks
 */

document.addEventListener('DOMContentLoaded', () => {
  // Period filter buttons (Today / Week / Month / Year) if present
  const periodFilterBtns = document.querySelectorAll('.dashboard-period-btn');
  periodFilterBtns.forEach(btn => {
    btn.addEventListener('click', function() {
      periodFilterBtns.forEach(b => b.classList.remove('active'));
      this.classList.add('active');
    });
  });
});
