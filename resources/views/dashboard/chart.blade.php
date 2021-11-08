@if (userRole() == 'owner')
    <div class="row">        
        <div class="col-12 col-md-7 d-flex">
            @include('dashboard.chart_parts.profit')
        </div>
        
        <div class="col-12 col-md-5 d-flex">
            @include('dashboard.chart_parts.yearly_finance')
        </div>

    </div>

    <div class="row">
        <div class="col-lg-12">
            @include('dashboard.chart_parts.finance')
        </div>
    </div>    
@endif


<div class="row">
    <div class="col-12 {{ userRole() == 'pegawai' ? 'col-md-8' : 'col-md-6' }} d-flex">
        @include('dashboard.chart_parts.empty_room')
    </div>
    
    @if (userRole() == 'manager' || userRole() == 'owner')
        <div class="col-12 col-md-6 d-flex">
            @include('dashboard.chart_parts.finance_per_room')
        </div>
    @endif
</div>
