document.addEventListener("DOMContentLoaded", () => {
  // Header Scroll Effect
  const header = document.getElementById("main-header");
  const headerContainer = document.getElementById("header-container");

  window.addEventListener("scroll", () => {
    if (window.scrollY > 10) {
      header.classList.add(
        "bg-white/90",
        "dark:bg-gray-900/90",
        "backdrop-blur-md",
        "shadow-sm",
      );
      header.classList.remove("border-transparent");
      header.classList.add("border-gray-200", "dark:border-gray-800");
      headerContainer.classList.remove("h-20");
      headerContainer.classList.add("h-16");
    } else {
      header.classList.remove(
        "bg-white/90",
        "dark:bg-gray-900/90",
        "backdrop-blur-md",
        "shadow-sm",
      );
      header.classList.add("border-transparent");
      header.classList.remove("border-gray-200", "dark:border-gray-800");
      headerContainer.classList.remove("h-16");
      headerContainer.classList.add("h-20");
    }
  });

  // Dark Mode Toggle Logic
  const themeToggleBtn = document.getElementById("theme-toggle");
  const themeToggleDarkIcon = document.getElementById("theme-toggle-dark-icon");
  const themeToggleLightIcon = document.getElementById(
    "theme-toggle-light-icon",
  );

  // 초기 아이콘 설정
  if (
    localStorage.getItem("theme") === "dark" ||
    (!("theme" in localStorage) &&
      window.matchMedia("(prefers-color-scheme: dark)").matches)
  ) {
    themeToggleLightIcon.classList.remove("hidden");
  } else {
    themeToggleDarkIcon.classList.remove("hidden");
  }

  if (themeToggleBtn) {
    themeToggleBtn.addEventListener("click", function () {
      // 현재 다크모드인지 확인 (클래스 기준)
      const isDark = document.documentElement.classList.contains("dark");

      if (isDark) {
        // 다크 -> 라이트로 변경
        document.documentElement.classList.remove("dark");
        localStorage.setItem("theme", "light");

        // 아이콘 변경: 해(Light) 숨김, 달(Dark) 표시
        themeToggleLightIcon.classList.add("hidden");
        themeToggleDarkIcon.classList.remove("hidden");
      } else {
        // 라이트 -> 다크로 변경
        document.documentElement.classList.add("dark");
        localStorage.setItem("theme", "dark");

        // 아이콘 변경: 달(Dark) 숨김, 해(Light) 표시
        themeToggleDarkIcon.classList.add("hidden");
        themeToggleLightIcon.classList.remove("hidden");
      }
    });
  }

  // Mobile Menu Toggle
  const mobileMenuBtn = document.getElementById("mobile-menu-btn");
  const mobileMenu = document.getElementById("mobile-menu");

  if (mobileMenuBtn) {
    mobileMenuBtn.addEventListener("click", () => {
      mobileMenu.classList.toggle("hidden");

      // 모바일 메뉴 열릴 때 헤더 배경색 강제 적용
      if (!mobileMenu.classList.contains("hidden") && window.scrollY <= 10) {
        header.classList.add("bg-white", "dark:bg-gray-900");
      } else if (window.scrollY <= 10) {
        header.classList.remove("bg-white", "dark:bg-gray-900");
      }
    });
  }

  // Image Modal Logic (For Bulletin/Gallery)
  const modalImages = document.querySelectorAll(".zoomable-image");
  if (modalImages.length > 0) {
    // Create Modal Element
    const modal = document.createElement("div");
    modal.id = "image-modal";
    modal.className =
      "fixed inset-0 z-[60] bg-black/90 hidden flex items-center justify-center p-4 cursor-zoom-out";
    modal.innerHTML = `
            <img src="" alt="Zoomed Image" class="max-w-full max-h-full object-contain rounded-md shadow-2xl transition-transform duration-300 scale-95 opacity-0">
            <button class="absolute top-4 right-4 text-white hover:text-gray-300 focus:outline-none">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
        `;
    document.body.appendChild(modal);

    const modalImg = modal.querySelector("img");
    const closeBtn = modal.querySelector("button");

    const openModal = (src) => {
      modalImg.src = src;
      modal.classList.remove("hidden");
      // Animation
      setTimeout(() => {
        modalImg.classList.remove("scale-95", "opacity-0");
        modalImg.classList.add("scale-100", "opacity-100");
      }, 10);
      document.body.style.overflow = "hidden";
    };

    const closeModal = () => {
      modalImg.classList.remove("scale-100", "opacity-100");
      modalImg.classList.add("scale-95", "opacity-0");
      setTimeout(() => {
        modal.classList.add("hidden");
        modalImg.src = "";
      }, 300);
      document.body.style.overflow = "";
    };

    modalImages.forEach((img) => {
      img.addEventListener("click", () => openModal(img.src));
    });

    modal.addEventListener("click", (e) => {
      if (
        e.target === modal ||
        e.target === closeBtn ||
        e.target.closest("button") === closeBtn
      ) {
        closeModal();
      }
    });

    document.addEventListener("keydown", (e) => {
      if (e.key === "Escape" && !modal.classList.contains("hidden")) {
        closeModal();
      }
    });
  }
});
