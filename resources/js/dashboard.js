
    //barchart
    $(document).ready(function() {
        // Pass the chatData array from PHP to JavaScript
        let chatData = @json_encode($chatData);

        // Extract labels (party names) and values (counts)
        let labels = chatData.map(data => data.name);
        let counts = chatData.map(data => data.count);

        // Create bar chart
        let ctx = document.getElementById('partyChart').getContext('2d');
        let partyChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels, // Party names
                datasets: [{
                    label: 'Numbers of GST Bills',
                    data: counts, // Count of bills
                    backgroundColor: 'rgb(115, 3, 0)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    });

    //line
    $(document).ready(function() {
        // Pass the chatData array from PHP to JavaScript
        let chatData = <?php echo json_encode($chatData); ?>;

        // Extract labels (party names) and values (counts)
        let labels = chatData.map(data => data.name);
        let counts = chatData.map(data => data.count);

        // Create bar chart
        let ctx = document.getElementById('partyChart_area').getContext('2d');
        let partyChart_area = new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels, // Party names
                datasets: [{
                    label: 'Numbers of GST Bills',
                    data: counts, // Count of bills
                    backgroundColor: 'rgb(115, 235, 55)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    });

    //donut
    $(document).ready(function() {
        // Pass the chatData array from PHP to JavaScript
        let chatData = <?php echo json_encode($chatData); ?>;

        // Extract labels (party names) and values (counts)
        let labels = chatData.map(data => data.name);
        let counts = chatData.map(data => data.count);

        // Create donut chart with shadow and 3D effect
        let ctx = document.getElementById('partyChart_area_donut').getContext('2d');
        let partyChart_area_donut = new Chart(ctx, {
            type: 'doughnut', // Doughnut chart
            data: {
                labels: labels, // Party names
                datasets: [{
                    label: 'Numbers of GST Bills',
                    data: counts, // Count of bills
                    backgroundColor: [
                        'rgb(255, 99, 132)',
                        'rgb(8, 130, 252)',
                        'rgb(255, 206, 86)',
                        'rgb(75, 192, 192)',
                        'rgb(153, 102, 255)',
                        'rgb(255, 159, 64)',
                        'rgb(255, 99, 132)',
                        'rgb(7, 236, 144)'
                    ], // Multiple colors for each section
                    hoverOffset: 7, // Larger hover effect for 3D illusion
                    borderColor: '#fff', // White border for a 3D effect
                    borderWidth: 2
                }]
            },
            options: {
                cutout: '30%', // Creates the donut hole size
                rotation: -45, // Rotate to give a more dynamic look
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    tooltip: {
                        enabled: true
                    }
                }
            }
        });
    });


    $(document).ready(function() {

        $('#selectAmmountBaseOnDate').on('submit', function(e) {
            e.preventDefault();

            // Debugging: Check if the values are being fetched correctly
            console.log($('#from_date_s1').val()); // Logs the from_date value
            console.log($('#to_date_s1').val()); // Logs the to_date value

            $.ajax({
                url: "{{ route('fiterDataText') }}",
                method: "post",
                data: {
                    from_date: $('#from_date_s1').val(),
                    to_date: $('#to_date_s1').val(),
                    _token: "{{ csrf_token() }}"
                },
                success: function(response) {
                    console.log(response);
                    const selectAmmountBaseOnDate = response.selectAmmountBaseOnDate;
                    updateText(selectAmmountBaseOnDate);
                },
                error: function(error) {
                    alert('An error occurred');
                    console.log(error);
                }
            });
        });

        function updateText(selectAmmountBaseOnDate) {
            if (selectAmmountBaseOnDate) {
                $('#amount').text(selectAmmountBaseOnDate);
            } else {
                $('#amount').text("NaN");
            }
        }






        $('#data-form').on('submit', function(e) {
            e.preventDefault();

            // Fetch data using AJAX
            $.ajax({
                url: "{{ route('filterData') }}",
                method: 'POST',
                data: {
                    from_date: $('#from_date').val(),
                    to_date: $('#to_date').val(),
                    client_name: $('#client_name').val(),
                    _token: "{{ csrf_token() }}"
                },
                success: function(response) {
                    console.log(response);
                    const netAmount = response.net_amount;
                    updateSpeedometer(netAmount);
                },
                error: function(error) {
                    alert('An error occurred while fetching data.');
                    console.log(error);
                }
            });
        });

        // Function to update the speedometer
        function updateSpeedometer(netAmount) {
            let maxAmount = 50000;
            let degree = (netAmount / maxAmount) * 180;
            if (degree > 180) degree = 180;

            $('#needle').css('transform', `rotate(${degree}deg)`);
            $('#speed-label').text(netAmount);
            $('#total-amount').text(`Net Amount: ${netAmount}`);
        }


        $.ajax({
            url: "{{ route('dashboard') }}", // The route that returns party data
            method: "GET",
            success: function(response) {
                console.log(response); // Inspect the structure of the response
                const partyNames = response.map(party => party.party_name);
                const partyCounts = response.map(party => party.party_count);

                renderBarChart(partyNames, partyCounts);
            },
            error: function(error) {
                console.error('Error fetching data:', error);
            }
        });

        // Function to render the bar chart using Chart.js
        function renderBarChart(partyNames, partyCounts) {
            const ctx = document.getElementById('partyBarChart').getContext('2d');
            console.log('Rendering chart with:', partyNames, partyCounts); // Debug
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: partyNames,
                    datasets: [{
                        label: 'Number of GST Bills',
                        data: partyCounts,
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        }

    });
