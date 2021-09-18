@php
    $pageHeadTitle = ($pageHeadTitle) ? $pageHeadTitle : null;
    @endphp
<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h3>{{ $pageHeadTitle  }}</h3>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                {{--<li class="breadcrumb-item"><a href="#">Customers</a></li>
                <li class="breadcrumb-item active">Create</li>
                {!! $breadcrumbs !!}--}}
            </ol>
        </div>
    </div>
	@if(!empty($headerBtns))
	<div class="row mb-2">
		<div class="col-sm-6">

		</div>
		<div class="col-sm-6">


			<div class="heading-elements float-sm-right">
			<div class="">
				@foreach($headerBtns as $btn)
				@include('partials.header-element-btn',
					[
					    'id' => $btn['id'],
						'text' => $btn['text'],
						'extraCls' => isset($btn['extraCls'])?$btn['extraCls']:null,
						'iconCls' => isset($btn['iconCls'])?$btn['iconCls']:null,
						'href' => isset($btn['href'])?$btn['href']:null,
						'anchorExtra' => isset($btn['anchorExtra'])?$btn['anchorExtra']:null,
					]
				)
				@endforeach
			</div>
			</div>


		</div>
	</div>
	@endif
</div><!-- /.container-fluid -->

<style>
.heading-elements111 {
    background-color: inherit;
    position: absolute;
    top: 8%;
    right: 20px;
    height: 38px;
    margin-top: -19px;
}
</style>
