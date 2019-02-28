<div class="border yui3-cssreset my-preview">
                <div class="my-preview_inner">
@if($target != 'sheet')
                    <h2 class="my-preview_title">検収書</h2>

                    <table class="my-preview-layout">
                        <tbody>
                            <tr>
                                <td class="my-preview-layout_l">
                                    <h3 class="my-preview_subtitle">{{env('COMPANY_NAME')}}</h3>
                                </td>
                                <td class="my-preview-layout_r">
                                    <table class="my-preview-data my-preview-data-label">
                                        <tbody>
                                            <tr>
                                                <th>No</th>
                                                <td>{{ $myProject['project_no'] }}</td>
                                            </tr>
                                            <tr>
                                                <th>検収日</th>
    @if($target == 'result')
                                                <td><span>{{ date('Y年n月j日', strtotime($myProject['accept_at'])) }}</span></td>
    @else
                                                <td><span class="my-preview-dummy">0000年0月0日</span></td>
    @endif
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <p class="my-preview_text">下記に関し、検収致しました。</p>
@endif

                    <table class="my-preview-layout">
                        <tbody>
                            <tr>
                                <td class="my-preview-layout_l">
                                    <table class="my-preview-data my-preview-data-outline">
                                        <tbody>
                                            <tr>
                                                <th class="my-preview-data_w30p">件名</th>
                                                <td>{{ $myProject['project_name'] }}</td>
                                            </tr>
                                            <tr>
                                                <th>納期</th>
                                                <td>{{ date('Y年n月j日', strtotime($myProject['invoice_dates'])) }}</td>
                                            </tr>
                                            <tr>
                                                <th>支払条件</th>
                                                <td>{{ $myProject['payment_term_name'] }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <table class="my-preview-data my-preview-data-total">
                                        <tbody>
                                            <tr>
                                                <th class="my-preview-data_w30p">合計金額</th>
                                                <td>{{ number_format(intval($myProject['total'],10) + intval($myProject['tax'],10)) }}円（税込）</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
@if($target != 'sheet')
                                <td class="my-preview-layout_r">
                                    <h3>{{ $myProject['client_name'] }}</h3>
                                    <p>
                                        〒{{ $myProject['client_zip'] }}<br>
                                        {{ $myProject['client_pref'] }}{{ $myProject['client_address1'] }}<br>
    @if($myProject['client_address2'])
                                        {{ $myProject['client_address2'] }}<br>
    @endif
                                        TEL：{{ $myProject['client_tel'] }}<br>
                                    </p>
    @if($target == 'result')
                                    <p>{{ $myProject['first_name'] }} {{ $myProject['last_name'] }}</p>
    @else
                                    <p class="my-preview-dummy">苗字 名前</p>
    @endif
                                </td>
@endif
                            </tr>
                        </tbody>
                    </table>

                    <table class="my-preview-data my-preview-data-items">
                        <thead>
                            <tr>
                                <th scope="col">摘要</th>
                                <th scope="col">数量</th>
                                <th scope="col">単位</th>
                                <th scope="col">単価</th>
                                <th scope="col">金額</th>
                            </tr>
                        </thead>
                        <tbody>
@foreach($myProject['delivery_details'] as $aDetail)
                            <tr>
    @if($aDetail['document_detail_kbn'] == 2)
                                <th colspan="5">{{ $aDetail['section_description'] }}</th>
    @elseif($aDetail['description'] == "" || $aDetail['description'] == "　　")

    @elseif( $aDetail['quantity'] == '' && $aDetail['unit'] == '' && $aDetail['unit_price'] == '' && $aDetail['price'] == '')
                                <td colspan="5">{{ $aDetail['description'] }}</td>
    @else
                                <th>{{ $aDetail['description'] }}</th>
                                <td class="my-preview-data_num">@if($aDetail['quantity'] != '') {{ number_format(intval($aDetail['quantity'],10)) }} @endif</td>
                                <td>@if($aDetail['unit'] != '') {{ $aDetail['unit'] }} @endif</td>
                                <td class="my-preview-data_num">@if($aDetail['unit_price'] != '') {{ number_format(intval($aDetail['unit_price'],10)) }} @endif</td>
                                <td class="my-preview-data_num">@if($aDetail['price'] != '') {{ number_format(intval($aDetail['price'],10)) }} @endif</td>
    @endif
                            </tr>
@endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="2" rowspan="3" class="my-preview-data_blank"></td>
                                <th colspan="2">小計</th>
                                <td class="my-preview-data_num">{{ number_format(intval($myProject['total'],10)) }}</td>
                            </tr>
                            <tr>
                                <th colspan="2">消費税</th>
                                <td class="my-preview-data_num">{{ number_format(intval($myProject['tax'],10)) }}</td>
                            </tr>
                            <tr>
                                <th colspan="2">合計</th>
                                <td class="my-preview-data_num">{{ number_format(intval($myProject['total'],10) + intval($myProject['tax'],10)) }}</td>
                            </tr>
                        </tfoot>
                    </table>

                    <table class="my-preview-data my-preview-data-etc">
                        <tbody>
                            <tr>
                                <th scope="row">備考</th>
                            </tr>
                            <tr>
@if( $myProject['delivery_message'] != "" )
                                <td>{!! preg_replace('/\n\r/i', '<br>', $myProject['delivery_message']) !!}</td>
@else
                                <td>なし</td>
@endif
                            </tr>
                        </tbody>
                    </table>

                </div>
            </div>
