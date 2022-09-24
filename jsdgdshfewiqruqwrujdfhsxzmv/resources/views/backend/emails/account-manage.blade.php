<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional //EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

        <meta name="viewport" content="width=device-width">

        <!--[if !mso]><!-->

        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <!--<![endif]-->

        <title></title>

        <!--[if !mso]><!-->

        <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" type="text/css">

        <link rel="stylesheet" href="{{asset('frontend/css/LineIcons.css')}}">


        <!--<![endif]-->

        <style type="text/css">

            body {

                margin: 0;

                padding: 0;

            }



            table,

            td,

            tr {

                vertical-align: top;

                border-collapse: collapse;

            }



            * {

                line-height: inherit;

            }



            a[x-apple-data-detectors=true] {

                color: inherit !important;

                text-decoration: none !important;

            }

        </style>

        <style type="text/css" id="media-query">

            @media (max-width: 620px) {



                .block-grid,

                .col {

                    min-width: 320px !important;

                    max-width: 100% !important;

                    display: block !important;

                }



                .block-grid {

                    width: 100% !important;

                }



                .col {

                    width: 100% !important;

                }



                .col_cont {

                    margin: 0 auto;

                }



                img.fullwidth,

                img.fullwidthOnMobile {

                    max-width: 100% !important;

                }



                .no-stack .col {

                    min-width: 0 !important;

                    display: table-cell !important;

                }



                .no-stack.two-up .col {

                    width: 50% !important;

                }



                .no-stack .col.num2 {

                    width: 16.6% !important;

                }



                .no-stack .col.num3 {

                    width: 25% !important;

                }



                .no-stack .col.num4 {

                    width: 33% !important;

                }



                .no-stack .col.num5 {

                    width: 41.6% !important;

                }



                .no-stack .col.num6 {

                    width: 50% !important;

                }



                .no-stack .col.num7 {

                    width: 58.3% !important;

                }



                .no-stack .col.num8 {

                    width: 66.6% !important;

                }



                .no-stack .col.num9 {

                    width: 75% !important;

                }



                .no-stack .col.num10 {

                    width: 83.3% !important;

                }



                .video-block {

                    max-width: none !important;

                }



                .mobile_hide {

                    min-height: 0px;

                    max-height: 0px;

                    max-width: 0px;

                    display: none;

                    overflow: hidden;

                    font-size: 0px;

                }



                .desktop_hide {

                    display: block !important;

                    max-height: none !important;

                }

            }

        </style>

    </head>
    <body class="clean-body" style="margin: 0; padding: 0; -webkit-text-size-adjust: 100%; background-color: #e2eace;">
            <p style='margin-top:0cm;margin-right:0cm;margin-bottom:8.0pt;margin-left:0cm;line-height:107%;font-size:15px;font-family:"Calibri",sans-serif;'><span style='font-size:15px;line-height:107%;font-family:"Arial",sans-serif;color:#1D1C1D;'>Hello,</span></p>
            <p style='margin-top:0cm;margin-right:0cm;margin-bottom:8.0pt;margin-left:0cm;line-height:107%;font-size:15px;font-family:"Calibri",sans-serif;'><span style='font-size:15px;line-height:107%;font-family:"Arial",sans-serif;color:#1D1C1D;'>I we have sending the {{$data['user_id']}} ( {{$data['user_name']}} ) account package details,</span></p>
            <table style="width:80%">
                <tr>
                    <td> No Of Employee : <td>
                    <td> {{$data['number_of_selected_user']}} <td>
                    <td></td>
                </tr>
                <tr>
                    <td> User Cost: <td>
                    <td> {{$data['user_cost']}} <td>
                    <td></td>
                </tr>
                <tr>
                    <td colspan="3">
                        Selected Package details are as follow :
                    </td>
                </tr>
                <tr>
                    <td colspan="3">
                        <table style="width:100%"  border="1">
                            <tr>
                                <td> Package Id </td>
                                <td> Package Name </td>
                                <td> Package Qty</td>
                                <td> Amount </td>
                            </tr>
                            @foreach($data['PackageDetail'] as $value)
                                <tr>
                                    <td> {{$value['package_id']}} </td>
                                    <td> {{$value['package']}} </td>
                                    <td> {{$value['package_qty']}} </td>
                                    <td> {{$value['amount']}} </td>
                                </tr>
                            @endforeach
                        </table>
                    </td>
                </tr>
                <tr>
                    <td colspan="3">
                        No of employee details are as follow:
                    </td>
                </tr>
                <tr>
                    <td colspan="3">
                        <table style="width:100%"  border="1">
                            <tr>
                                <td> Name </td>
                                <td> Email </td>
                                <td> Package </td>
                            </tr>
                            @foreach($data['userDetail'] as $value)
                                <tr>
                                    <td> {{$value['user_name']}} </td>
                                    <td> {{$value['user_email']}} </td>
                                    <td> {{$value['user_package']}} </td>
                                </tr>
                            @endforeach
                        </table>
                    </td>
                </tr>
            </table>
    </body>
</html>
