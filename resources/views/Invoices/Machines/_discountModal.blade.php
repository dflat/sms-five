<div id="discountModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 id="hovered-icon-text" class="modal-title">Apply Discount</h4>
      </div>
      <div class="modal-body">


       	<div class="modal-location-button" data-destination="All Machine Invoices">
         		
            {!! Form::open(['url' => '/electronic/discount']) !!}

            <div class="form-group">

              {!! Form::hidden('invoice_id', $invoice->invoice_no) !!}

              {!! Form::label('discount','Discount Type:') !!}
              {!! Form::select('discount', array('F' => 'Flat Rate', 'D' => 'Dollars Off', 'P' => 'Percentage Off'), 'F',['class' => 'form-control']) !!}
            </div>

           
            <input class="form-control pad-bottom" type="number" step="any" placeholder="Amount" id="inputDiscount" name="discount_value" required>

            <div class="form-group">
              {!! Form::submit('Apply To Invoice',['class' => 'btn btn-primary form-control']) !!}
           </div>
       	    {!! Form::close() !!}
        </div>

        <div class="modal-location-button pull-right" data-destination="All Machine Invoices">
          @if($invoice->dollar_discount > 0 || $invoice->percent_discount > 0 || $invoice->flat_rate > 0)
          Current Discount:
          <br>
          @endif

          @if($invoice->dollar_discount > 0)
            <span class="badge pull-right">${{$invoice->dollar_discount}} Off</span>
          @endif
          @if($invoice->percent_discount > 0)
           <span class="badge pull-right">{{$invoice->percent_discount * 100}}% Off</span>
          @endif
          @if($invoice->flat_rate > 0)
           <span class="badge pull-right">Flat Rate: {{$invoice->flat_rate}}</span>
          @endif
        </div>
    
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>