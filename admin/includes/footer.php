
</div>
<!-- /#wrapper -->

<!-- jQuery -->
<script src="js/jquery-3.2.1.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>

<!-- Dropzone Core JavaScript -->
<script src="js/dropzone.js"></script>

<!-- WYSIWYG Editor -->
<!--<script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=b3ci474z9ayqarisyj66zqm892pfutman3iwmgf2t0q78evf"></script>-->

<!-- Custom Js -->
<script src="js/scripts.js"></script>

<script type="text/javascript">
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {

        var data = google.visualization.arrayToDataTable([
            ['Task',     'Snapshot'],
            ['Views',    <?php echo $session ->count; ?>],
            ['Comments', <?php echo Comment::count_all(); ?>],
            ['Users',    <?php echo User::count_all(); ?>],
            ['Photos',   <?php echo Photo::count_all(); ?>]
        ]);

        var options = {
            legend :'none',
            pieSliceText :'label',
            title: 'Snapshot Daily Activities',
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
    }
</script>

</body>

</html>