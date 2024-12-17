@extends('layout.app')

@section('content')
<style>
    .speedometer {
        padding: 50px;
        width: 350px;
        height: 175px;
        margin-left: 150px;
        border-bottom: 10px solid #ddd;
        border-radius: 1000px 1000px 0 0;
        background-color: #f4f4f4;
        position: relative;
        overflow: hidden;
    }

    .needle {
        width: 25px;
        height: 170px;
        background: linear-gradient(to bottom, #333, #666);
        position: absolute;
        left: 45%;
        top: calc(100% - 170px);
        transform-origin: bottom center;
        transform: rotate(0deg);
        transition: transform 1s ease-out;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.5);
        border-radius: 100% 100% 0% 0%;
    }

    .needle:hover {
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.7);
        transition: box-shadow 0.3s ease;
    }

    .speed-label {
        font-size: 24px;
        text-align: center;
        margin-top: 20px;
    }

    .total-amount {
        text-align: center;
        margin-top: 1px;
        font-size: 18px;
    }

    .dashboard-header {
        background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
        color: white;
        padding: 20px 0;
        margin-bottom: 30px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .card-box {
        border-radius: 15px;
        box-shadow: 0 0 30px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
    }

    .card-box:hover {
        transform: translateY(-5px);
        box-shadow: 0 5px 30px rgba(0, 0, 0, 0.15);
    }

    .card_scolor {
        background: linear-gradient(135deg, #FF6B6B 0%, #FFE66D 100%);
    }

    .card_bcolor {
        background: linear-gradient(135deg, #4E65FF 0%, #92EFFD 100%);
    }


    /* speedometter */
    /* Speedometer Styles */
    .speedometer {
        width: 500px;
        height: 300px;
        background: radial-gradient(circle at center, #ffffff, #e3e3e3);
        border: 10px solid #444;
        border-radius: 50%;
        position: relative;
        margin: 20px auto;
        box-shadow: 10px 10px 30px rgba(0, 0, 0, 0.2);
    }

    .needle {
        width: 20px;
        height: 200px;
        background: #f00;
        position: absolute;
        top: 50%;
        left: 50%;
        transform-origin: bottom center;
        transform: rotate(0deg);
        transition: transform 0.5s ease;
    }

    .speed-label {
        font-size: 24px;
        color: #333;
        margin-top: 10px;
    }

    .total-amount {
        font-size: 18px;
        color: #555;
        margin-top: 5px;
        text-align: center;
    }

    /* Form Styles */
    .form-group label {
        font-weight: bold;
    }

    .form-control {
        border-radius: 10px;
        border: 2px solid #007bff;
        padding: 10px;
        box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    select.form-control {
        background-image: linear-gradient(to right, #007bff, #0069d9);
        color: white;
        font-weight: bold;
    }

    button.btn-primary {
        background: linear-gradient(45deg, #007bff, #0069d9);
        border: none;
        border-radius: 10px;
        font-weight: bold;
        padding: 10px 15px;
        transition: background 0.3s ease;
    }

    button.btn-primary:hover {
        background: linear-gradient(45deg, #0056b3, #004099);
    }

    /* Container Styles */
    .row.card {
        background: linear-gradient(135deg, #f5f5f5 50%, #e6e6e6 50%);
        border-radius: 15px;
        padding: 20px;
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        margin: 20px 0;
    }

    .box {
        width: 100%;
        display: flex;
        justify-content: space-around;
        align-items: center;
    }

    .col-md-6 {
        padding: 20px;
    }

    h2,
    h3 {
        font-family: 'Poppins', sans-serif;
        font-weight: 700;
        color: #333;
    }

    .bg-danger {
        background: linear-gradient(135deg, #ff4e4e 0%, #ff7474 100%);
        border-radius: 50%;
        padding: 10px;
    }

    .bg-white {
        background-color: white;
        border-radius: 15px;
        padding: 20px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }

    .text-primary {
        color: #007bff;
    }

    .text-center {
        text-align: center;
    }

    /* Responsive Styles */
    @media (max-width: 768px) {
        .box {
            flex-direction: column;
            align-items: center;
        }

        .col-md-6 {
            width: 100%;
            padding: 10px;
        }
    }

    /* dchgbjknlm;,s */
    .glossy-card {

        background: linear-gradient(135deg, #00ffcc, #00ccff);
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        border-radius: 20px;
        border: 1px solid rgba(255, 255, 255, 0.18);
        box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.37);
        padding: 2px;
        margin-bottom: 3px;
    }

    .glossy-card .card-header {

        background: transparent;
        border-bottom: 1px solid rgba(255, 255, 255, 0.2);
        padding-bottom: 1px;
        margin-bottom: 2px;
    }

    .glossy-card h2 {
        color: #333;
        text-shadow: 1px 1px 2px rgba(255, 255, 255, 0.5);
    }

    .glossy-card .form-control {
        background: rgba(255, 255, 255, 0.2);
        border: none;
        border-radius: 10px;
        padding: 10px 15px;
        color: #333;
    }

    .glossy-card .form-control:focus {
        box-shadow: 0 0 0 2px rgba(0, 255, 204, 0.5);
    }

    .glossy-card label {
        color: #555;
        text-shadow: 1px 1px 1px rgba(255, 255, 255, 0.5);
    }

    .glossy-card .btn-dark {
        background: linear-gradient(135deg, #00ffcc, #00ccff);
        border: none;
        border-radius: 10px;
        padding: 10px 20px;
        color: #fff;
        font-weight: bold;
        text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.2);
        transition: all 0.3s ease;
    }

    .glossy-card .btn-dark:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
    }

    .glossy-card #amount {
        font-size: 4rem;
        color: #00ffcc;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
    }

    /* chart */
    
</style>

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title font-weight-bold">DASHBOARD</h4>
            </div>
        </div>      
    </div>
    <!-- card upper box  ---------- -->
    <div class="row">
        <div class="col-md-6 col-xl-3">
            <div class="widget-rounded-circle card-box card_scolor">
                <div class="row">
                    <div class="col-6">
                        <div class="avatar-lg rounded-circle bg-soft-primary border-primary border">
                            <i class="fe-users font-22 avatar-title text-primary"></i>
                        </div>
                    </div>
                    <div class="col-6 text-right">
                        <h2 class="text-light">{{ $partyCount }}</h2>
                        <p class="text-light mb-1  ">Total Parties</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-xl-3">
            <div class="widget-rounded-circle card-box card_bcolor">
                <div class="row">
                    <div class="col-6">
                        <div class="avatar-lg rounded-circle bg-soft-success border-success border">
                            <i class="fe-shopping-cart font-22 avatar-title text-success"></i>
                        </div>
                    </div>
                    <div class="col-6 text-right">
                        <h2 class="text-light">{{ $gstBillCount }}</h2>
                        <p class=" mb-1 text-light">GST Invoices</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-xl-3">
            <div class="widget-rounded-circle card-box bg-primary text-white">
                <div class="row">
                    <div class="col-5">
                        <div class="avatar-lg rounded-circle bg-soft-info border-info border">
                            <i class="fe-bar-chart-line- font-22 avatar-title text-info"></i>
                        </div>
                    </div>
                    <div class="col-6 text-right p-0 m-0">
                        <h2 class="text-white">{{ number_format($totalTransaction, 0) }}</h2>
                        <p class="text-light mb-1 text-truncate small_text">Total Transactions</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-xl-3">
            <div class="widget-rounded-circle card-box bg-warning text-dark">
                <div class="row">
                    <div class="col-6">
                        <div class="avatar-lg rounded-circle bg-soft-warning border-warning border">
                            <i class="fe-eye font-22 avatar-title text-warning"></i>
                        </div>
                    </div>
                    <div class="col-6 text-right">
                        <h2 class="text-light">{{ $orderCount }}</h2>
                        <p class="text-light mb-1 text-truncate small_text">Orders</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- spodometter section -->
    <div class="row card rounded p-2">
        <div class="box d-flex justify-content-center">
            <div class="col-md-6">
                <h2 class="text-center">Speedometer</h2>
                <div class="speedometer text-center bg-danger">
                    <div class="needle" id="needle"></div>
                </div>
                <div class="speed-label" id="speed-label">0</div>
                <div class="total-amount" id="total-amount">Net Amount: 0</div>
            </div>

            <div class="col-md-6 p-3 bg-white rounded shadow-sm">
                <h3 class="text-center text-primary">Data Filter</h3>
                <form id="data-form">
                    @csrf
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="from_date">From Date</label>
                            <input type="date" class="form-control" id="from_date" name="from_date" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="to_date">To Date</label>
                            <input type="date" class="form-control" id="to_date" name="to_date" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="client_name">Client Name</label>
                        <select class="form-control" id="client_name" name="client_name" required>
                            @foreach($existingClient as $client)
                            <option value="{{ $client->Full_name }}">{{ $client->Full_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Get Data</button>
                </form>
            </div>
        </div>
    </div>
    <hr>
    <!--  -->
    <div class="row glossy-card">
        <h2 class="card-header text-center">Calculate the Amount based on the date</h2>
        <div class="col-12 card-body">
            <div class="row card shadow-sm rounded" style="background: linear-gradient(#00ffcc, #ffffff);">
                <h2 class="card-header text-center text-primary">Calculate the Amount based on the date</h2>
                <div class="col-12 card-body">
                    <div class="date-box" style="display: flex; justify-content: center;">
                        <form id="selectAmmountBaseOnDate" method="post" class="d-flex align-items-end">
                            @csrf
                            <div class="form-group col-md-5 mr-3">
                                <label for="from_date_s1" class="font-weight-bold">From Date</label>
                                <input type="date" class="form-control form-control-lg" id="from_date_s1" name="from_date" required>
                            </div>
                            <div class="form-group col-md-5">
                                <label for="to_date_s1" class="font-weight-bold">To Date</label>
                                <input type="date" class="form-control form-control-lg" id="to_date_s1" name="to_date" required>
                            </div>
                            <button type="submit" class="btn btn-dark btn-lg ml-3" style="height:40 px;">Get Data</button>
                        </form>
                    </div>

                    <div class="text-center">
                        <h1 class="display-4 font-weight-bold text-primary">Amount</h1>
                        <h3 id="amount" class="display-1 text-dark" style="font-size: 150px;">56</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="card">
        <div class="container mt-5">
            <div class="row d-flex">
                <div class="col-6">
                    <h3 class="text-center">Party Entries in Party Table and GST Bills</h3>
                    <canvas id="partyChart" width="300" height="200"></canvas>
                </div>

                <div class="col-6">
                    <h3 class="text-center">Party Entries in Party Table and GST Bills</h3>
                    <canvas id="partyChart_area" width="300" height="200"></canvas>
                </div>
            </div>
            <div class="row">
                <div class="col-6 p-4 text-center">
                </div>
                <div class="col-6 p-4 text-center   ">
                    <h3 class="text-center">Party Entries in Party Table and GST Bills</h3>
                    <canvas id="partyChart_area_donut" style="max-width: auto; max-height: 600px;"></canvas> <!-- Set a smaller size -->
                </div>
            </div>
        </div>
        <div class="row m-3">
            <div class="col-12 card ">
                <h3 class="text-center card-header">Party Entries in Party Table and GST Bills</h3>
                <div class="card-body">
                    <form id="filterForm" class="rounded border p-3">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="from_date_chart" class="form-label">From Date:</label>
                                <input type="date" class="form-control" id="from_date_chart" name="from_date_chart" required>
                            </div>
                            <div class="col-md-6">
                                <label for="to_date_chart" class="form-label">To Date:</label>
                                <input type="date" class="form-control" id="to_date_chart" name="to_date_chart" required>
                            </div>
                        </div>
                        <div class="mt-3">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                    <hr>

                    <canvas id="partyChart_area_date" width="300" height="100" style="display:none;"></canvas>

                </div>

            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


<script>
    //date + barchart
    $(document).ready(function() {
        $('#filterForm').on('submit', function(e) {
            e.preventDefault();

            let fromDate = $('#from_date_chart').val();
            let toDate = $('#to_date_chart').val();

            $.ajax({
                url: '/dateTime_gstbill',
                method: 'POST',
                data: {
                    from_date_chart: fromDate,
                    to_date_chart: toDate,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    let chatData = response.chatData;

                    // Extract labels and values for the chart
                    let labels = chatData.map(data => data.name);
                    let counts = chatData.map(data => data.count);

                    // Display the canvas and create a bar chart
                    $('#partyChart_area_date').show();
                    let ctx = document.getElementById('partyChart_area_date').getContext('2d');
                    new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: labels,
                            datasets: [{
                                label: 'Number of GST Bills',
                                data: counts,
                                backgroundColor: [
                                    'rgb(255, 99, 132)',
                                    'rgb(54, 162, 235)',
                                    'rgb(255, 206, 86)',
                                    'rgb(75, 192, 192)',
                                    'rgb(153, 102, 255)',
                                    'rgb(255, 159, 64)'
                                ],
                                borderColor: 'rgb(0, 0, 0)',
                                borderWidth: 2
                            }]
                        },
                        options: {
                            responsive: true,
                            scales: {
                                x: {
                                    beginAtZero: true
                                },
                                y: {
                                    beginAtZero: true
                                }
                            }
                        }
                    });
                },
                error: function() {
                    alert('Error retrieving data.');
                }
            });
        });
    });


    //barchart
    $(document).ready(function() {
        // Pass the chatData array from PHP to JavaScript
        let chatData = <?php echo json_encode($chatData); ?>;

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
</script>
@endsection