
// Show corresponding form based on the role selected
const roleSelector = document.getElementById('user_role');
roleSelector.addEventListener('change', function() {
    const recruiterForm = document.getElementById('recruiterForm');
    const seekerForm = document.getElementById('seekerForm');
    if (this.value === 'recruiter') {
        recruiterForm.style.display = 'block';
        seekerForm.style.display = 'none';
    } else if (this.value === 'seeker') {
        seekerForm.style.display = 'block';
        recruiterForm.style.display = 'none';
    } else {
        recruiterForm.style.display = 'none';
        seekerForm.style.display = 'none';
    }
});