<x-app-layout>
<div class="col-lg-9">
        @if(session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        @endif
        <div class="tab-pane fade show active" id="bookings">
            <div class="dashboard-box">
                <div class="dashboard-title">
                    <h4>upcoming booking</h4>
                </div>
                @if($upcomingFlightBookings->count())
                    @foreach($upcomingFlightBookings as $ticket)
                        @if($ticket->productBooking)
                        @php
                            $customer = json_decode($ticket->productBooking->details);
                            $product = $ticket->productBooking->product->getProductDetail();
                            $destination = $ticket->productBooking->product->flightTicketWithTrashed->flightTicketsDestination;
                            $productDetail = $destination->fromAirport->cityName . ' - ' . $destination->toAirport->cityName;
                            $price = property_exists($customer, 'price') ? $customer->price : 0;
                            $payment = $ticket->productBooking->payment;
                        @endphp
                            <div class="dashboard-detail">
                                <div class="booking-box">
                                    <div class="date-box">
                                        <span class="day">{{date('D', strtotime($ticket->productBooking->product->flightTicketWithTrashed->departure_date_time))}}</span>
                                        <span class="date">{{date('d', strtotime($ticket->productBooking->product->flightTicketWithTrashed->departure_date_time))}}</span>
                                        <span class="month">{{date('M', strtotime($ticket->productBooking->product->flightTicketWithTrashed->departure_date_time))}}</span>
                                    </div>
                                    <div class="detail-middle">
                                        <div class="media">
                                            <div class="icon">
                                                <i class="fas fa-plane"></i>
                                            </div>
                                            <div class="media-body">
                                                <h6 class="media-heading">{{$productDetail}}</h6>
                                                <p>amount paid: <span>INR {{$payment->amount}}</span></p>
                                            </div>
                                            <div class="media-body">
                                                <h6 class="media-heading">ID: {{$ticket->productBooking->booking_id}}</h6>
                                                <p>order date: <span>{{date('d M, Y', strtotime($ticket->productBooking->created_at))}}</span></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="detail-last">
                                    @if('sent_to_customer' == $ticket->status && $ticket->pnr)
                                        <a href="/send-ticket/{{$ticket->id}}"><span class="badge badge-info">Send Ticket</span></a>
                                    
                                    @elseif('paid' != $ticket->status)
                                        <a href="/flight-tickets/confirm-booking/{{$payment->id}}"><span class="badge badge-warning">Make Payment</span></a>
                                    @else
                                        <span class="badge badge-danger">Waiting for PNR</span>
                                    @endif
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
