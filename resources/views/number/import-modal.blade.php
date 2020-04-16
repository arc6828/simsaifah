<!-- Button trigger modal -->
<button type="button" class="btn btn-primary btn-sm float-right" data-toggle="modal" data-target="#importModal">
  <i class="fa fa-database  mr-2"></i> Update Database
</button>

<!-- Modal -->
<div class="modal fade" id="importModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">อัพเดท Database : เบอร์โทร</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-right">
                <form  method="POST" action="{{ url('/number') }}" accept-charset="UTF-8" style="display:none" id="delete-form">
                    {{ method_field('DELETE') }}
                    {{ csrf_field() }}
                    <button type="submit" class="btn btn-danger btn-sm " id="btn-delete" title="Delete All Numbers" onclick="return confirm(&quot;Confirm to delete all numbers?&quot;)">
                        <i class="fa fa-trash-o" aria-hidden="true"></i> ลบเบอร์โทรทั้งหมด
                    </button>
                </form>
            
                <form method="POST" action="{{ url('/number/import') }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                    {{ csrf_field() }}

                    <textarea class="form-control" name="sql" id="sql" rows=5"" placeholder="place code here ..." required></textarea>
                    <div class="text-right mt-4">
                        <a class="btn btn-danger " href="javascript::void();"
                            onclick="event.preventDefault(); document.getElementById('btn-delete').click();">
                            <i class="fa fa-trash-o" aria-hidden="true"></i> ลบเบอร์โทรทั้งหมด
                        </a>
                        <button type="button" class="btn btn-outline-primary" data-dismiss="modal">ยกเลิก</button>
                        <button type="submit" class="btn btn-primary">นำเข้าเบอร์โทร</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>