import './bootstrap';

// Theme Management System
document.addEventListener('DOMContentLoaded', function() {
    // Initialize theme from localStorage or system preference
    initializeTheme();
    
    // Set up theme toggle listeners
    setupThemeToggles();
    
    // Set up flash messages
    setupFlashMessages();
    
    // Initialize page transitions
    initializePageTransitions();
});

function initializePageTransitions() {
    // Add a slight delay to ensure DOM is fully loaded
    setTimeout(() => {
        const mainContent = document.querySelector('main');
        if (mainContent) {
            mainContent.classList.add('page-loaded');
            mainContent.classList.remove('page-loading');
        }
    }, 100);
    
    // Store current URL to detect back/forward navigation
    window.addEventListener('popstate', function() {
        const mainContent = document.querySelector('main');
        if (mainContent) {
            mainContent.classList.add('page-loading');
            mainContent.classList.remove('page-loaded');
            
            // Ensure dark mode state is preserved during navigation
            const isDarkMode = document.documentElement.classList.contains('dark');
            if (isDarkMode) {
                document.documentElement.style.backgroundColor = '#0f172a';
            }
            
            setTimeout(() => {
                mainContent.classList.add('page-loaded');
                mainContent.classList.remove('page-loading');
            }, 300);
        }
    });
    
    // Add event handler for navigation clicks to ensure dark mode is preserved
    document.addEventListener('click', function(e) {
        // Only handle clicks on navigation links with our custom transition setup
        if (e.target.tagName === 'A' && e.target.hasAttribute('@click.prevent')) {
            // Preserve dark mode state during transition
            const isDarkMode = document.documentElement.classList.contains('dark');
            if (isDarkMode) {
                document.documentElement.style.backgroundColor = '#0f172a';
                localStorage.setItem('theme', 'dark');
            }
        }
    });
}

function setupThemeToggles() {
    // Get all theme toggle buttons - there may be multiple across different layouts
    const themeToggles = document.querySelectorAll('[id^="theme-toggle"]');
    
    if (themeToggles.length > 0) {
        themeToggles.forEach(toggle => {
            toggle.addEventListener('click', toggleTheme);
        });
    }
}

function setupFlashMessages() {
        const successMessage = document.getElementById('success-message');
        const errorMessage = document.getElementById('error-message');
        
        if (successMessage) {
            setTimeout(() => {
                successMessage.classList.add('opacity-0');
                setTimeout(() => {
                    successMessage.style.display = 'none';
                }, 300);
            }, 3000);
        }
        
        if (errorMessage) {
            setTimeout(() => {
                errorMessage.classList.add('opacity-0');
                setTimeout(() => {
                    errorMessage.style.display = 'none';
                }, 300);
            }, 3000);
        }
}

function initializeTheme() {
    // Check for saved theme preference or use system preference
    const savedTheme = localStorage.getItem('theme');
    const systemPrefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
    const isDarkMode = savedTheme === 'dark' || (!savedTheme && systemPrefersDark);
    
    // Apply theme
    setTheme(isDarkMode);
    
    // Listen for system theme changes
    window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', e => {
        if (!localStorage.getItem('theme')) {
            setTheme(e.matches);
        }
    });
}

function toggleTheme() {
    const isDarkMode = document.documentElement.classList.contains('dark');
    
    // Add transition class for smooth animation
    document.documentElement.classList.add('transitioning');
    
    // Set theme after a small delay to ensure transitions work
    setTimeout(() => {
        setTheme(!isDarkMode);
        
        // Remove transition class after transitions are complete
        setTimeout(() => {
            document.documentElement.classList.remove('transitioning');
        }, 300);
    }, 10);
}

function setTheme(isDarkMode) {
    // Toggle dark class on html element
    document.documentElement.classList.toggle('dark', isDarkMode);
    
    // Update icons - find all possible theme toggle icons across layouts
    updateThemeToggleIcons(isDarkMode);
    
    // Save preference to localStorage
    localStorage.setItem('theme', isDarkMode ? 'dark' : 'light');
    
    // Dispatch custom event for other components to listen for
    document.dispatchEvent(new CustomEvent('themeChanged', { 
        detail: { theme: isDarkMode ? 'dark' : 'light' } 
    }));
}

function updateThemeToggleIcons(isDarkMode) {
    // Find all dark icons and light icons
    const darkIcons = document.querySelectorAll('[id$="theme-toggle-dark-icon"]');
    const lightIcons = document.querySelectorAll('[id$="theme-toggle-light-icon"]');
    const themeTexts = document.querySelectorAll('[id$="theme-toggle-text"]');
    
    // Update dark/light icons visibility
    darkIcons.forEach(icon => {
        icon.classList.toggle('hidden', isDarkMode);
    });
    
    lightIcons.forEach(icon => {
        icon.classList.toggle('hidden', !isDarkMode);
    });
    
    // Update theme text if it exists
    themeTexts.forEach(text => {
        if (text) {
            text.textContent = isDarkMode ? 'Light Mode' : 'Dark Mode';
        }
    });
}

// Enhanced Modal System
window.openModal = function(content) {
    const modalContainer = document.getElementById('modal-container');
    const modalContent = modalContainer.querySelector('.modal-content');
    const modalBackdrop = modalContainer.querySelector('.modal-backdrop');
    
    // Set modal content
    modalContent.innerHTML = '';
    modalContent.appendChild(content);
    
    // Prepare for animation
    modalContent.classList.remove('scale-95', 'opacity-0');
    modalContent.classList.add('scale-100', 'opacity-100');
    
    // Show modal
    modalContainer.classList.remove('hidden');
    modalContainer.classList.add('flex');
    
    // Close modal when clicking outside
    modalBackdrop.addEventListener('click', function(e) {
        if (e.target === modalBackdrop) {
            closeModal();
        }
    });
    
    // Listen for escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeModal();
        }
    }, { once: true });
};

window.closeModal = function() {
    const modalContainer = document.getElementById('modal-container');
    const modalContent = modalContainer.querySelector('.modal-content');
    
    // Add closing animation
    modalContent.classList.remove('scale-100', 'opacity-100');
    modalContent.classList.add('scale-95', 'opacity-0');
    
    // Hide modal after animation
    setTimeout(() => {
        modalContainer.classList.add('hidden');
        modalContainer.classList.remove('flex');
    }, 200);
};

// Enhanced Toast System
window.showToast = function(message, type = 'info') {
    const toastContainer = document.getElementById('toast-container');
    
    if (!toastContainer) {
        console.error('Toast container not found');
        return;
    }
    
    const toast = document.createElement('div');
    
    // Set toast classes based on type
    let bgClass, iconHtml;
    
    switch(type) {
        case 'success':
            bgClass = 'bg-success-bg text-success-color';
            iconHtml = '<svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>';
            break;
        case 'error':
            bgClass = 'bg-danger-bg text-danger-color';
            iconHtml = '<svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path></svg>';
            break;
        case 'warning':
            bgClass = 'bg-warning-bg text-warning-color';
            iconHtml = '<svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>';
            break;
        default:
            bgClass = 'bg-bg-secondary text-foreground';
            iconHtml = '<svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>';
    }
    
    // Create toast element with modern design
    toast.className = `${bgClass} rounded-lg p-3 shadow-lg flex items-center justify-between space-x-4 transform translate-x-full border border-border/10 dark:border-border/20 opacity-0 transition-all duration-300`;
    toast.innerHTML = `
        <div class="flex items-center space-x-3">
            ${iconHtml}
            <p class="text-sm font-medium">${message}</p>
        </div>
        <button class="focus:outline-none focus:text-foreground/70" onclick="this.parentElement.remove()">
            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
            </svg>
        </button>
    `;
    
    // Add to container
    toastContainer.appendChild(toast);
    
    // Animate in
    setTimeout(() => {
        toast.classList.remove('translate-x-full', 'opacity-0');
    }, 10);
    
    // Remove after delay
    setTimeout(() => {
        toast.classList.add('translate-x-full', 'opacity-0');
        setTimeout(() => {
            toast.remove();
        }, 300);
    }, 5000);
};
