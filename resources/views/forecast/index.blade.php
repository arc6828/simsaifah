@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">

            <div class="col-md-12">
                <div class="card mb-4">
                    <div class="card-header">ทำนายเบอร์</div>
                    <div class="card-body">
                        <form method="GET" action="{{ url('/forecast') }}" accept-charset="UTF-8" class="" role="search">
                        <div class="row">
                            <div class="form-group col-lg-6">
                                <label for="">กรุณาระบุเบอร์ที่คุณต้องการทำนาย (ตัวเลข 10 หลัก)</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="tel" placeholder="" value="{{ request('tel') }}" autocomplete="off" pattern="[0-9]{10}">
                                </div>
                            </div>
                            <div class="form-group col-lg-3">
                                <label for="">วันที่ (วันที่/เดือน/ปี)</label>
                                <div class="input-group">
                                    <input type="date" class="form-control" name="date" placeholder="" value="{{ request('date') }}" autocomplete="off">
                                </div>
                            </div>
                            <div class="form-group col-lg-3">
                                <label for="">เวลา (ชั่วโมง:นาที)</label>
                                <div class="input-group">
                                    <input type="time" class="form-control" name="time" placeholder="" value="{{ request('time') }}" autocomplete="off">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-lg">
                                <label for="">คะแนนของเบอร์</label><br>
                                {{ $forecast }}
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-lg">
                                <a class="btn btn-outline-success" href="{{ url('/forecast') }}" >ยกเลิก</a>
                                <button class="btn btn-success" type="submit">ทำนายเบอร์</button>
                            </div>
                        </div>
                        <div class="row">
                        <div class="form-group col-lg">
                                <label for="">คำทำนาย</label>
                                {{ $mean1->content }}
                                {{ $mean2->content }}
                                {{ $mean3->content }}
                                {{ $mean4->content }}
                            </div>
                        </div>
                        <div class="row">
                        <div class="form-group col-lg">
                                <label for="">Radar Chart</label>
                                <canvas id="myChart" style="max-width: 600px; max-height : 600px;"></canvas>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.bundle.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.css">

<script>
var ctx = document.getElementById('myChart');
var jArray= <?php echo json_encode($plotchart); ?>;
var myChart = new Chart(ctx, {
    type: 'radar',
    data: {
        labels: ['ความรัก', 'เสี่ยงโชค', 'ครอบครัว', 'สังคม', 'การเงิน', 'สุขภาพ'],
        datasets: [{
            label: 'กราฟคะแนนคำทำนาย',
            //data: [12, 19, 3, 5, 2, 3],
            data: jArray,
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
});
</script>

@endsection


