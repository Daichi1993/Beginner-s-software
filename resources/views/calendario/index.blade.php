<!DOCTYPE html>
<html lang="en">

@include('file_comuni.header')
@include('file_comuni.menu') // MENU
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">



 




 




                </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->


 

    <!-- inizio_fine-->
    <!-- Main content -->
 

 

                        </ul>
                    </div>
                </div>
            </div>
        </div>
</div>
</div>
</section>
</div>
 
</body>
@include('file_comuni.footer')

<script>
    $(function() {
    $("#calendar").dxCalendar({
        // ...
        disabledDates: function(args) {
            const dayOfWeek = args.date.getDay();
            const month = args.date.getMonth();
            const isWeekend = args.view === "month" && (dayOfWeek === 0 || dayOfWeek === 6 );
            const isMarch = (args.view === "year" || args.view === "month") && month === 2;
 
            return isWeekend || isMarch;
        }
    });
});
    </script>



</html>