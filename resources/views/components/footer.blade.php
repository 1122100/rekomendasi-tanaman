<footer class="z-20 relative bg-gradient-to-r from-green-600 to-emerald-800 text-white pt-16">
  <!-- Updated SVG wave that connects with content above -->
  <div class="absolute top-0 left-0 w-full overflow-hidden leading-[0] transform -translate-y-full">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none" class="w-full h-16 text-white">
      <path d="M0,0V46.29c47.79,22.2,103.59,32.17,158,28,70.36-5.37,136.33-33.31,206.8-37.5C438.64,32.43,512.34,53.67,583,72.05c69.27,18,138.3,24.88,209.4,13.08,36.15-6,69.85-17.84,104.45-29.34C989.49,25,1113-14.29,1200,52.47V0Z" opacity=".25" class="fill-current"></path>
      <path d="M0,0V15.81C13,36.92,27.64,56.86,47.69,72.05,99.41,111.27,165,111,224.58,91.58c31.15-10.15,60.09-26.07,89.67-39.8,40.92-19,84.73-46,130.83-49.67,36.26-2.85,70.9,9.42,98.6,31.56,31.77,25.39,62.32,62,103.63,73,40.44,10.79,81.35-6.69,119.13-24.28s75.16-39,116.92-43.05c59.73-5.85,113.28,22.88,168.9,38.84,30.2,8.66,59,6.17,87.09-7.5,22.43-10.89,48-26.93,60.65-49.24V0Z" opacity=".5" class="fill-current"></path>
      <path d="M0,0V5.63C149.93,59,314.09,71.32,475.83,42.57c43-7.64,84.23-20.12,127.61-26.46,59-8.63,112.48,12.24,165.56,35.4C827.93,77.22,886,95.24,951.2,90c86.53-7,172.46-45.71,248.8-84.81V0Z" class="fill-current"></path>
    </svg>
  </div>

  <div class="container mx-auto px-6 pb-12">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
      <div class="space-y-4">
        <h4 class="text-2xl font-semibold">Tentang Kami</h4>
        <p class="text-gray-200 leading-relaxed">
          Aplikasi rekomendasi tanaman modern dengan UI minimalis, mengusung teknologi Fuzzy Logic Mamdani.
        </p>
      </div>

      <!-- Section 2: Navigasi Cepat -->
      <div class="space-y-4">
        <h4 class="text-2xl font-semibold">Navigasi</h4>
        <ul class="space-y-2">
          <li><a href="{{ route('home') }}" class="hover:underline">Beranda</a></li>
          <li><a href="{{ route('galery') }}" class="hover:underline">Galeri</a></li>
          <li><a href="{{ route('rekomendasi') }}" class="hover:underline">Rekomendasi</a></li>
          <li><a href="{{ route('profile.edit') }}" class="hover:underline">Profil</a></li>
        </ul>
      </div>

      <!-- Section 3: Contact & Social -->
      <div class="space-y-4">
        <h4 class="text-2xl font-semibold">Hubungi Kami</h4>
        <p class="flex items-center space-x-2">
          <!-- Email Icon SVG -->
          <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M4 4h16v16H4z" stroke-linejoin="round" />
            <polyline points="4,4 12,12 20,4" stroke-linejoin="round" />
          </svg>
          <span>rahmatmaliki@unisla.com</span>
        </p>
        <p class="flex items-center space-x-2">
          <!-- Phone Icon SVG -->
          <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.82 19.82 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6A19.82 19.82 0 0 1 2.08 4.18 2 2 0 0 1 4 2h3a2 2 0 0 1 2 1.72c.12.81.37 1.6.72 2.34a2 2 0 0 1-.45 2.11L8 9a16 16 0 0 0 6 6l.83-1.29a2 2 0 0 1 2.11-.45c.74.35 1.53.6 2.34.72A2 2 0 0 1 22 16.92z" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
          <span>+62 838 4342 6015</span>
        </p>
        <div class="flex space-x-4">
          <!-- Social Icon SVGs -->
          <a href="#" class="hover:opacity-80 transition-opacity">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 24 24" fill="currentColor">
              <path d="M22 12c0-5.52-4.48-10-10-10S2 6.48 2 12c0 4.99 3.66 9.12 8.44 9.88v-6.99H7.9v-2.89h2.54V9.41c0-2.5 1.49-3.89 3.77-3.89 1.09 0 2.23.195 2.23.195v2.45h-1.25c-1.23 0-1.61.76-1.61 1.54v1.85h2.74l-.44 2.89h-2.3v6.99C18.34 21.12 22 16.99 22 12z"/>
            </svg>
          </a>
          <a href="#" class="hover:opacity-80 transition-opacity">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 24 24" fill="currentColor">
              <path d="M12 2.04c-5.51 0-9.96 4.45-9.96 9.96s4.45 9.96 9.96 9.96 9.96-4.45 9.96-9.96S17.51 2.04 12 2.04zm5.04 7.2c-.14-1.9-1.08-3.58-2.58-4.62-.94-.63-2.02-1.02-3.12-1.12C10.45 3.4 9.72 3.36 9 3.36s-1.45.04-2.34.14c-1.1.1-2.18.49-3.12 1.12C2.58 5.66 1.64 7.34 1.5 9.24c-.09 1.47-.09 4.44 0 5.91.14 1.9 1.08 3.58 2.58 4.62.94.63 2.02 1.02 3.12 1.12.89.1 1.62.14 2.34.14s1.45-.04 2.34-.14c1.1-.1 2.18-.49 3.12-1.12 1.5-1.04 2.44-2.72 2.58-4.62.09-1.47.09-4.44 0-5.91z"/>
              <circle cx="12" cy="12" r="3.2"/>
            </svg>
          </a>
          <a href="#" class="hover:opacity-80 transition-opacity">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 24 24" fill="currentColor">
              <path d="M22.23 5.924c-.793.352-1.64.588-2.533.694a4.42 4.42 0 0 0 1.945-2.438 8.839 8.839 0 0 1-2.8 1.07A4.405 4.405 0 0 0 16.616 4c-2.447 0-4.427 1.98-4.427 4.427 0 .347.038.684.114 1.008A12.503 12.503 0 0 1 3.149 5.15a4.424 4.424 0 0 0-.6 2.226c0 1.533.78 2.887 1.962 3.676a4.395 4.395 0 0 1-2.005-.554v.056c0 2.21 1.572 4.053 3.655 4.471a4.413 4.413 0 0 1-1.997.076c.563 1.76 2.197 3.042 4.135 3.078A8.845 8.845 0 0 1 2 19.54a12.478 12.478 0 0 0 6.75 1.976c8.096 0 12.526-6.706 12.526-12.526 0-.19-.004-.379-.012-.566a8.94 8.94 0 0 0 2.204-2.285z"/>
            </svg>
          </a>
        </div>
      </div>
    </div>

    <!-- Divider -->
    <div class="border-t border-white border-opacity-30 my-8"></div>

    <!-- Bottom Bar -->
    <div class="flex flex-col md:flex-row justify-between items-center text-sm text-gray-200">
      <p>© {{ date('Y') }} Rahmat Maliki. Hak Cipta Dilindungi Undang‑Undang.</p>
      <div class="space-x-4 mt-4 md:mt-0">
        <a href="#" class="hover:underline">Privacy Policy</a>
        <a href="#" class="hover:underline">Terms of Service</a>
      </div>
    </div>
  </div>

  <!-- Bottom wave SVG -->
  <div class="absolute bottom-0 left-0 w-full overflow-hidden leading-[0]">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none" class="w-full h-12 text-green-700 rotate-180">
      <path d="M0,0V46.29c47.79,22.2,103.59,32.17,158,28,70.36-5.37,136.33-33.31,206.8-37.5C438.64,32.43,512.34,53.67,583,72.05c69.27,18,138.3,24.88,209.4,13.08,36.15-6,69.85-17.84,104.45-29.34C989.49,25,1113-14.29,1200,52.47V0Z" class="fill-current opacity-20"></path>
    </svg>
  </div>
</footer>
