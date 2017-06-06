<div id="calendar-reservation" ng-controller="ReservationCtrl as reservation">
    <h2>Check availability</h2>
    <div class="row">
        <div class="col-sm-4">
            <datepicker date-format="dd-MM-yyyy" selector="form-control">
                <div class="input-group">
                    <input id="startdate" class="form-control" placeholder="Choose date of arrival" ng-model="reservation.state.startdate" ng-change="reservation.events.nextDate()"/>
                    <span class="input-group-addon" style="cursor: pointer">
                        <i class="fa fa-lg fa-calendar"></i>
                    </span>
                </div>
            </datepicker>
        </div>
        <div class="col-sm-4">
            <datepicker date-format="yyyy-MM-dd" selector="form-control">
                <div class="input-group">
                    <input id="enddate" class="form-control" placeholder="Choose date of departure" ng-model="reservation.state.enddate"/>
                    <span class="input-group-addon" style="cursor: pointer">
                        <i class="fa fa-lg fa-calendar"></i>
                    </span>
                </div>
            </datepicker>
        </div>
        <div class="col-sm-4">
            <button class="btn btn-secundary">Check</button>
        </div>
    </div>
</div>