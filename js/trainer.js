document.addEventListener('DOMContentLoaded', function() {
    const addTrainerForm = document.getElementById('add-trainer-form');
    const trainersTable = document.getElementById('trainers-table').getElementsByTagName('tbody')[0];

    // Fetch and display trainers
    function getTrainers() {
        fetch('php/api/trainer.php')
            .then(response => response.json())
            .then(data => {
                trainersTable.innerHTML = '';
                data.forEach(trainer => {
                    const row = trainersTable.insertRow();
                    row.innerHTML = `
                        <td>${trainer.Trainer_id}</td>
                        <td>${trainer.Name}</td>
                        <td>${trainer.Email_id}</td>
                        <td>${trainer.Contact_Number}</td>
                        <td>${trainer.Manager_id}</td>
                    `;
                });
            });
    }

    // Add a new trainer
    addTrainerForm.addEventListener('submit', function(event) {
        event.preventDefault();
        const formData = new FormData(addTrainerForm);
        const data = Object.fromEntries(formData.entries());

        fetch('php/api/trainer.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)
        })
        .then(response => response.json())
        .then(result => {
            console.log(result);
            getTrainers();
            addTrainerForm.reset();
        });
    });

    // Initial load
    getTrainers();
});
