@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">

            <div class="col-md-12">
                <div class="card mb-4">
                    <div class="card-body">
                        <h4 class="mb-4">ทำนายเบอร์</h4> 
                        <form method="GET" action="{{ url('/forecast') }}" accept-charset="UTF-8" class="" role="search">
                            <div class="row">
                                <div class="form-group col-lg-4">
                                    <label for="">กรุณาระบุเบอร์ที่ต้องการทำนาย (ตัวเลข 10 หลัก) <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="tel" placeholder="" value="{{ request('tel') }}" autocomplete="off" pattern="[0-9]{10}" required>
                                    </div>
                                </div>
                                <div class="form-group col-lg-4">
                                    <label for="">วันที่เกิด (เดือน/วันที่/ปี)</label>
                                    <div class="input-group">
                                        <input type="date" class="form-control" name="date" placeholder="" value="{{ request('date') }}" autocomplete="off">
                                    </div>
                                </div>
                                <div class="form-group col-lg-2">
                                    <label for="hour">เวลาเกิด (ชั่วโมง)</label>
                                    <div class="input-group">
                                    <select id="hour" name="hour" class="form-control">
                                        <option value="">ไม่ระบุ</option>
                                        <option value="00">00</option>
                                        <option value="01">01</option>
                                        <option value="02">02</option>
                                        <option value="03">03</option>
                                        <option value="04">04</option>
                                        <option value="05">05</option>
                                        <option value="06">06</option>
                                        <option value="07">07</option>
                                        <option value="08">08</option>
                                        <option value="09">09</option>
                                        <option value="10">10</option>
                                        <option value="11">11</option>
                                        <option value="12">12</option>
                                        <option value="13">13</option>
                                        <option value="14">14</option>
                                        <option value="15">15</option>
                                        <option value="16">16</option>
                                        <option value="17">17</option>
                                        <option value="18">18</option>
                                        <option value="19">19</option>
                                        <option value="20">20</option>
                                        <option value="21">21</option>
                                        <option value="22">22</option>
                                        <option value="23">23</option>
                                    </select>
                                    <script>
                                        document.querySelector("#hour").value = "{{ request('hour') }}";
                                    </script>
                                    </div>
                                </div>
                                <div class="form-group col-lg-2">
                                    <label for="minute">เวลาเกิด (นาที)</label>
                                    <div class="input-group">
                                    <select id="minute" name="minute" class="form-control">
                                        <option value="">ไม่ระบุ</option>
                                        <option value="00">00</option>
                                        <option value="01">01</option>
                                        <option value="02">02</option>
                                        <option value="03">03</option>
                                        <option value="04">04</option>
                                        <option value="05">05</option>
                                        <option value="06">06</option>
                                        <option value="07">07</option>
                                        <option value="08">08</option>
                                        <option value="09">09</option>
                                        <option value="10">10</option>
                                        <option value="11">11</option>
                                        <option value="12">12</option>
                                        <option value="13">13</option>
                                        <option value="14">14</option>
                                        <option value="15">15</option>
                                        <option value="16">16</option>
                                        <option value="17">17</option>
                                        <option value="18">18</option>
                                        <option value="19">19</option>
                                        <option value="20">20</option>
                                        <option value="21">21</option>
                                        <option value="22">22</option>
                                        <option value="23">23</option>
                                        <option value="24">24</option>
                                        <option value="25">25</option>
                                        <option value="26">26</option>
                                        <option value="27">27</option>
                                        <option value="28">28</option>
                                        <option value="29">29</option>
                                        <option value="30">30</option>
                                        <option value="31">31</option>
                                        <option value="32">32</option>
                                        <option value="33">33</option>
                                        <option value="34">34</option>
                                        <option value="35">35</option>
                                        <option value="36">36</option>
                                        <option value="37">37</option>
                                        <option value="38">38</option>
                                        <option value="39">39</option>
                                        <option value="40">40</option>
                                        <option value="41">41</option>
                                        <option value="42">42</option>
                                        <option value="43">43</option>
                                        <option value="44">44</option>
                                        <option value="45">45</option>
                                        <option value="46">46</option>
                                        <option value="47">47</option>
                                        <option value="48">48</option>
                                        <option value="49">49</option>
                                        <option value="50">50</option>
                                        <option value="51">51</option>
                                        <option value="52">52</option>
                                        <option value="53">53</option>
                                        <option value="54">54</option>
                                        <option value="55">55</option>
                                        <option value="56">56</option>
                                        <option value="57">57</option>
                                        <option value="58">58</option>
                                        <option value="59">59</option>
                                    </select>
                                    <script>
                                        document.querySelector("#minute").value = "{{ request('minute') }}";
                                    </script>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-lg">
                                    <a class="btn btn-outline-success" href="{{ url('/forecast') }}" >ยกเลิก</a>
                                    <button class="btn btn-success" type="submit">ทำนายเบอร์</button>
                                </div>
                            </div>                        
                        </form>
                    </div>
                </div>
                @if(isset($forecast))
                <div class="card mb-4">
                    <div class="card-body">         
                        <h4 class="mb-4"><span class="mr-2">ผลลัพธ์ทำนายเบอร์</span> <span class="grade-label">{{ request('tel') }} </span></h4>                
                        <div class="row">
                            <div class="form-group col-lg">                                
                                <div class="text-center mt-4 d-none">
                                    <div class="d-inline rounded bg-primary text-light">
                                        <div style="font-size : 20px; border-right:1px solid #aaa;  height:50px;" class="px-4 py-3 d-inline">เบอร์เกรด</div> 
                                        <div style="font-size : 40px; height:100px;" class="px-4 py-3 d-inline">{{ $forecast }}</div>
                                    </div>
                                </div>
                                @php
                                    //$forecast = "F";
                                    $color = "";
                                    switch($forecast){
                                        case "A+" : 
                                        case "A" :
                                            $color = "text-success";
                                            break;

                                            
                                        case "B" :
                                            $color = "text-primary";
                                            break;
                                        case "C" :
                                            $color = "text-warning";
                                            break;
                                        case "D" :
                                        case "F" :
                                            $color = "text-danger";
                                            break;
                                    }
                                @endphp
                                <style>
                                    .grade-label{
                                        color : #888;      
                                        font-size: 1.35rem;                                  
                                    }
                                    .grade{
                                        font-size: 4rem;
                                    }
                                </style>
                                <div class="text-center mt-4">                                    
                                    <label> 
                                        <span class="grade-label mr-2">เกรด </span>
                                        <span class="grade {{ $color }}">{{ $forecast }} </span>
                                    </label>
                                </div>
                                <div class="mt-4">
                                    <h6 class="mt-4">บุคลิก</h6>
                                    <p> {{ isset($mean1) ? $mean1->content : '' }}</p>
                                    <h6 class="mt-4">การสื่อสาร</h6>
                                    <p> {{ isset($mean2) ? $mean2->content : '' }}</p>
                                    <h6 class="mt-4">ความคิด</h6>
                                    <p> {{ isset($mean3) ? $mean3->content : '' }}</p>
                                    <h6 class="mt-4">จิตใจ</h6>
                                    <p> {{ isset($mean4) ? $mean4->content : '' }}</p>
                                </div>
                            </div>                           
                        
                            
                            @if(isset($plotchart))
                            <div class="form-group col-lg text-center">
                                <canvas id="myChart" style="max-width: 600px; max-height : 600px;"></canvas>
                                <div> <label >เลขตัวตน คือ {{$key1}},{{$key2}}</label ></div>
                                <div class="mt-4"><label >เบอร์ {{ request('tel') }} เสริมดวงให้เจ้าของเบอร์ที่เกิดใน<br>วัน<span id="my-date">{{ request('date') }}</span> เวลา {{ request('hour',' - ') }}:{{ request('minute',' - ') }} น. คิดเป็น</label></div>                                
                                <style>
                                    #result th, #result td{
                                        width: 50%;
                                    }
                                </style>
                                <table class="table table-sm text-center table-bordered mt-2" id="result">
                                    <tr>
                                        <th>ความรัก</th> <td>{{ $plotchart[0] * 10 }}% </td>
                                    </tr>
                                    <tr>
                                        <th>ลูกหลานและโชคลาภ</th><td>{{ $plotchart[1] * 10 }}% </td>
                                    </tr>
                                    <tr>
                                        <th>ครอบครัว</th><td>{{ $plotchart[2] * 10 }}% </td>
                                    </tr>
                                    <tr>
                                        <th>สังคม</th><td>{{ $plotchart[3] * 10 }}% </td>
                                    </tr>
                                    <tr>
                                        <th>การเงิน</th><td>{{ $plotchart[4] * 10 }}% </td>
                                    </tr>
                                    <tr>
                                        <th>สุขภาพ</th><td>{{ $plotchart[5] * 10 }}% </td>
                                    </tr>
                                </table>
                                <ul class="d-none">
                                    <li>ความรัก : {{ $plotchart[0] * 10 }}%</li>
                                    <li>ลูกหลาน<br>และโชคลาภ : {{ $plotchart[1] * 10 }}%</li>
                                    <li>ครอบครัว : {{ $plotchart[2] * 10 }}%</li>
                                    <li>สังคม : {{ $plotchart[3] * 10 }}%</li>
                                    <li>การเงิน : {{ $plotchart[4] * 10 }}%</li>
                                    <li>สุขภาพ : {{ $plotchart[5] * 10 }}%</li>
                                </ul>
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
                                        labels: ['ความรัก', 'ลูกหลานและโชคลาภ', 'ครอบครัว', 'สังคม', 'การเงิน', 'สุขภาพ'],
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
                                        scale: {
                                            ticks: {
                                                //beginAtZero: true
                                                min: 0,
                                                max: 10,
                                                showLabelBackdrop : true,
                                                display : false,
                                            }
                                        }
                                    }
                                });


                                
                                

                                document.addEventListener('DOMContentLoaded', (event) => {
                                    console.log('DOM fully loaded and parsed');

                                    var mydate = document.getElementById('my-date');
                                    var text = mydate.innerHTML;
                                    console.log(text);
                                
                                    console.log(new Date(text));
                                    moment.locale('th');
                                    console.log(moment().format("dddd, MMMM Do YYYY, h:mm:ss a"));
                                    //moment().format();
                                    
                                    mydate.innerHTML = text != "" ? moment(new Date(text)).format("ddddที่ Do MMMM YYYY") : " - ";
                                    
                                    
                                });
                                
                            </script>
                           
                            @endif
                        </div>
                    </div>
                </div>
                @endif

            </div>
        </div>
    </div>

@endsection


