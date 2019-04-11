<!-- Modal -->
<div class="modal fade" id="deleteID" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form role="form" method="POST" action="./deleteItem.php">
                    <div class="form-group">
                        <label for="Insert ID of good to change">Username</label>
                        <input type="number" class="form-control" name="id" placeholder="Enter id of good">
                    </div>
                    <button type="submit" class="btn btn-default btn-primary btn-block"> Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>