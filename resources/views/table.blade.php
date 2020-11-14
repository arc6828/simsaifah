<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">


<table class="table table-bordered table-striped" id="myTable"></table>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"> </script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
<script>
//alert("hello");
//https://explore.berthongpol.com/api/number

let url = "{{ url('api/number') }}";
fetch(url)
    .then(response => response.json())
    .then(data => {
        console.log(data)
        for(let i=0; i<data.length; i++){
            data[i].price = Number(data[i].price).toLocaleString('en'); 
        }
        // https://www.berthongpol.com/wp-content/uploads/2020/11/logo_happy.jpg
        $('#myTable').DataTable( {
            data : data,
            searching : false,
            info : false,
            paging : false,
            order : [[ 3, 'desc' ]],
            columns: [
                { 
                    data: 'operator' , 
                    title : 'ค่ายมือถือ',
                    render: function(data, type) {
                        if (type === 'display') {
                            let operator = '';    
                            switch (data.toLowerCase()) {
                                case 'ais':
                                    operator = 'logo_ais.jpg';
                                    break;
                                case 'dtac':
                                    operator = 'logo_dtac.jpg';
                                    break;
                                case 'happy':
                                    operator = 'logo_happy.jpg';
                                    break;
                                case 'truemove':                                
                                    operator = 'logo_truemove.jpg';
                                    break;                                
                            }
                            let img_url = "https://www.berthongpol.com/wp-content/uploads/2020/11/"+operator;
                            return '<img src="'+img_url+'" width="50" />';
                        }
    
                        return data;
                    }
                },
                { data: 'number' , title : 'เบอร์โทร'},
                { data: 'total'  , title : 'ผลรวม'},
                { data: 'price' , title : 'ราคา (บาท)' , className : 'dt-body-right'},
            ],
            columnDefs: [
                // { targets : [-1], className : 'dt-body-right' },                
                { targets : '_all', className : 'dt-center'  }
            ]
        } );
    });



</script>