// Initialize pilgrim type switching
document.addEventListener('DOMContentLoaded', function() {
    const pilgrimTypeButtons = document.querySelectorAll('.pilgrim-type');
    const registrationForm = document.getElementById('registrationForm');
    const mobileInputGroup = registrationForm?.querySelector('.mobile-input-group');
    let hiddenPilgrimType = registrationForm?.querySelector('input[name="pilgrim_type"]');

    if (!hiddenPilgrimType && registrationForm) {
        hiddenPilgrimType = document.createElement('input');
        hiddenPilgrimType.type = 'hidden';
        hiddenPilgrimType.name = 'pilgrim_type';
        registrationForm.appendChild(hiddenPilgrimType);
    }

    if (pilgrimTypeButtons.length) {
        // Set initial state
        updatePilgrimType('indian', pilgrimTypeButtons);

        // Add click handlers
        pilgrimTypeButtons.forEach(button => {
            button.addEventListener('click', function() {
                updatePilgrimType(this.dataset.type, pilgrimTypeButtons);
            });
        });
    }

    function updatePilgrimType(type, buttons) {
        // Update button states
        buttons.forEach(btn => {
            if (btn.dataset.type === type) {
                btn.classList.add('active');
                btn.classList.remove('btn-secondary');
            } else {
                btn.classList.remove('active');
                btn.classList.add('btn-secondary');
            }
        });

        // Update hidden input
        if (hiddenPilgrimType) {
            hiddenPilgrimType.value = type === 'indian' ? 'Indian Pilgrim' : 'Foreign Pilgrim';
        }

        // Update mobile input section visibility
        if (mobileInputGroup) {
            const indianMode = mobileInputGroup.querySelector('.indian-mode');
            const foreignMode = mobileInputGroup.querySelector('.foreign-mode');
            
            if (type === 'indian') {
                indianMode.style.display = 'block';
                foreignMode.style.display = 'none';
            } else {
                indianMode.style.display = 'none';
                foreignMode.style.display = 'block';
            }
        }
    }
});
