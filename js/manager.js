document.addEventListener('DOMContentLoaded', function() {
    const addManagerForm = document.getElementById('add-manager-form');
    const managersTable = document.getElementById('managers-table').getElementsByTagName('tbody')[0];

    // Fetch and display managers
    function getManagers() {
        fetch('php/api/manager.php')
            .then(response => response.json())
            .then(data => {
                managersTable.innerHTML = '';
                data.forEach(manager => {
                    const row = managersTable.insertRow();
                    row.innerHTML = `
                        <td>${manager.Manager_id}</td>
                        <td>${manager.Name}</td>
                        <td>${manager.Contact_Number}</td>
                        <td>${manager.Email_id}</td>
                    `;
                });
            });
    }

    // Add a new manager
    addManagerForm.addEventListener('submit', function(event) {
        event.preventDefault();
        const formData = new FormData(addManagerForm);
        const data = Object.fromEntries(formData.entries());

        fetch('php/api/manager.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)
        })
        .then(response => response.json())
        .then(result => {
            console.log(result);
            getManagers();
            addManagerForm.reset();
        });
    });

    // Initial load
    getManagers();
});
