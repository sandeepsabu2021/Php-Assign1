<script>
    function newimg(){
        window.open('changepic.php','popup','width=350, height=300 ,scrollbars=no, resizable=no');
    }
</script>
<table class="table table-striped text-center table-bordered mt-4">
    <thead class="bg-info text-white">
        <tr>
            <th colspan="2">User Details</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td colspan="2"><?php echo "<img class='user_pic' src='$pic' height='150px' width='150px'><br/>"; ?>
            <a href="changepic.php" onclick="newimg()" target="popup">Change Picture</a>
        </td>
        </tr>
        <tr>
            <td><b>Name:</b></td>
            <td><?php echo "$name"; ?></td>
        </tr>
        <tr>
            <td><b>Email:</b></td>
            <td><?php echo "$mail"; ?></td>
        </tr>
        <tr>
            <td><b>Age:</b></td>
            <td><?php echo "$age"; ?></td>
        </tr>
        <tr>
            <td><b>Gender:</b></td>
            <td><?php echo "$gen"; ?></td>
        </tr>
        
    </tbody>
</table>
