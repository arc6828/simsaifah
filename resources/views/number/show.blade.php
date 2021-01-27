@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="row">
            

            <div class="col-md-12">
                <div class="card">
                    <!-- <div class="card-header">เบอร์โทร {{ $number->number }}</div> -->
                    <div class="card-body">

                        <!-- <a href="{{ url('/number') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="{{ url('/number/' . $number->id . '/edit') }}" title="Edit Number"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                        <form method="POST" action="{{ url('number' . '/' . $number->id) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-sm" title="Delete Number" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                        </form>
                        <br/>
                        <br/> -->

                        <!-- <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr class="d-none">
                                        <th>ID</th><td>{{ $number->id }}</td>
                                    </tr>
                                    <tr><th> Number </th><td> {{ $number->number }} </td></tr><tr><th> Price </th><td> {{ $number->price }} </td></tr><tr><th> Operator </th><td> {{ $number->operator }} </td></tr>
                                    <tr><th> ผลรวม </th><td> {{ $number->total }} </td></tr>
                                </tbody>
                            </table>
                        </div> -->
                        <div class="card-body " >
                            <h4 class="card-title text-center py-4" style="font-size: 36px;">{{ substr($number->number,0,3)."-".substr($number->number,3,3)."-".substr($number->number,6,4) }}</h4>
                            <!-- <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p> -->
                            <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
                            <div class=" text-center px-4 py-2">                            
                                <strong style="font-size : 22px;">{{ number_format($number->price,0) }}.- </strong>
                            </div>
                            <div class="card-text ">
                                <div class="row">
                                
                                    <div class="col-5 text-center ">
                                        <img src="{{ url('/') }}/img/operators/logo_{{ strtolower($number->operator) }}.jpg" class="" width="100%" style="max-width:100px;"  alt="...">
                        
                                    </div>
                                    <div class="col-7 py-4 text-center">                            
                                        <label class="text-muted" style="font-size : 20px;">ผลรวม : {{ $number->total }}</label>
                                    </div>
                                    
                                    
                                    
                                </div>
                                <div class="text-center"> 
                                    <button type="button" class="btn btn-outline-primary" id="btn-clipboard" onclick="copy();"  data-toggle="popover" data-placement="top"  data-content="คัดลอกสำเร็จ">
                                        <i class="fa fa-copy"></i> คัดลอก
                                    </button>
                                    
                                    <input id="copy" type="" value="เบอร์ : {{ $number->number }} , ค่าย : {{ $number->operator }} ,ราคา : {{ number_format($number->price) }} บาท,  ผลรวม : {{ $number->total }} "                                
                                    />
                                </div>
                                <div class="text-center"> 
                                    <p><strong>Line Id</strong> : <a href="https://line.me/R/ti/p/%40037pahrc" data-type="URL" data-id="https://line.me/R/ti/p/%40037pahrc">@037pahrc</a></p>
                                    <a class="mt-4" href="https://line.me/R/ti/p/%40037pahrc"><img src="https://scdn.line-apps.com/n/line_add_friends/btn/th.png" alt="เพิ่มเพื่อน" height="36" border="0"></a>
                                </div>
                                <script>

                                    function copy(){
                                        console.log("CLICK");
                                        $("[data-toggle=popover]").popover('show');
                                        
                                        /* Get the text field */
                                        var copyText = document.getElementById("copy");

                                        /* Select the text field */
                                        copyText.select();
                                        copyText.setSelectionRange(0, 99999); /* For mobile devices */

                                        /* Copy the text inside the text field */
                                        document.execCommand("copy");

                                        /* Alert the copied text */
                                        //alert("Copied the text: " + copyText.value);
                                        
                                        

                                        setTimeout(function(){ $("[data-toggle=popover]").popover('hide'); }, 3000);
                                    }
                                </script>

                                
                            </div>
                            
                            <div class="card-text">
                                
                            </div>

                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
