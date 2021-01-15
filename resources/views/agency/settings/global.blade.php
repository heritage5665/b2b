<x-app-layout>
    <div class="col-lg-9">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="faq-content tab-content" id="top-tabContent">
            <div class="tab-pane fade active show" id="profile">
                <div class="dashboard-box">
                    <div class="dashboard-title">
                        <h4>global settings</h4>
                    </div>
                    <div class="dashboard-detail">
                        <form method="POST">
                            @csrf
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="markup">Markup</label>
                                    <input type="text" name='markup' value="{{$markup->amount}}" class="form-control" id="markup" placeholder="Markup">
                                </div>
                                <div class="form-group col-md-6">
                                
                                </div>
                               <!--  <div class="form-group col-md-12">
                                    <label for="gender">Passenger information</label>
                                    <textarea class="form-control" placeholder="Write Your Message" id="editor1" rows="12"></textarea>
                                </div> -->
                                <div class="form-group col-md-12">
                                    <button type="submit" class="btn btn-solid float-right">Save settings</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @php
       /* @push('scripts')
            <script type="text/javascript" src="{{ asset('/ckeditor/ckeditor.js') }}"></script>
        @endpush
        @push('inline_script')
            <script>
            
                CKEDITOR.replace( 'editor1' );
            </script>
        @endpush */
    @endphp
</x-app-layout>