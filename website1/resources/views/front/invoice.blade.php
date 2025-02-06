


  <!DOCTYPE html>
  <style>

  </style>

  <html>
  
  <body style="background-color:#e2e1e0;font-family: Open Sans, sans-serif;font-size:100%;font-weight:400;line-height:1.4;color:#000;">
    <table style="max-width:670px;margin:50px auto 10px;background-color:#fff;padding:50px;-webkit-border-radius:3px;-moz-border-radius:3px;border-radius:3px;-webkit-box-shadow:0 1px 3px rgba(0,0,0,.12),0 1px 2px rgba(0,0,0,.24);-moz-box-shadow:0 1px 3px rgba(0,0,0,.12),0 1px 2px rgba(0,0,0,.24);box-shadow:0 1px 3px rgba(0,0,0,.12),0 1px 2px rgba(0,0,0,.24); border-top: solid 10px #f8af3c;">
      <thead>
        <tr>
          <th style="text-align:left;"><img style="max-width: 150px;background: #f8af3c;" src="{{asset(getConfig('logo'))}}" alt="{{getConfig('website_name')}}"></th>
          <th style="text-align:right;font-weight:400;">{{$business->created_at}}  </th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td style="height:35px;"></td>
        </tr>
        <tr>
          <td colspan="2" style="border: solid 1px #ddd; padding:10px 20px;">
            <p style="font-size:14px;margin:0 0 6px 0;"><span style="font-weight:bold;display:inline-block;min-width:150px">Invoice</span><b style="color:#f8af3c;font-weight:normal;margin:0">#{{$business->id}}</b></p>
            <p style="font-size:14px;margin:0 0 6px 0;"><span style="font-weight:bold;display:inline-block;min-width:146px">Pay To:</span> Ideal-Spot</p>
            <p style="font-size:14px;margin:0 0 0 0;"><span style="font-weight:bold;display:inline-block;min-width:146px">Address</span>  {{getConfig('address') }} </p>
          </td>
        </tr>
      
        <tr>
          <td style="width:50%;padding:20px;vertical-align:top">
            <p style="margin:0 0 10px 0;padding:0;font-size:14px;"><span style="display:block;font-weight:bold;font-size:13px">Business Name:</span>  {{$business->name}}</p>
            <p style="margin:0 0 10px 0;padding:0;font-size:14px;"><span style="display:block;font-weight:bold;font-size:13px;">Start Time:</span> {{$business->start_time}}</p>
            <p style="margin:0 0 10px 0;padding:0;font-size:14px;"><span style="display:block;font-weight:bold;font-size:13px;">End time:</span> {{$business->end_time}}</p>
          </td>
          <td style="width:50%;padding:20px;vertical-align:top">
            <p style="margin:0 0 10px 0;padding:0;font-size:14px;"><span style="display:block;font-weight:bold;font-size:13px;"> Address*</span>{{$business->address}}</p>
            <p style="margin:0 0 10px 0;padding:0;font-size:14px;"><span style="display:block;font-weight:bold;font-size:13px;">Phone</span> {{$business->phone}}</p>
          </td>

      
        </tr>
        <tr>
          <td style="height:35px;"></td>
        </tr>
     
        <tr>
          <td style="height:35px;"></td>
        </tr>

      </tbody>
    
      <tfooter>
        <tr>
          <td colspan="2" style="font-size:14px;padding:50px 15px 0 15px;">
            <strong style="display:block;margin:0 0 10px 0;">Regards</strong>{{getConfig('website_name')}}<br> <br><br>
            <b>Phone:</b>  {{  getConfig('contact') }}<br>
            <b>Email:</b>{{getConfig('primary_email') }}
          </td>
        </tr>
      </tfooter>
    </table>
  </body>

  </html>