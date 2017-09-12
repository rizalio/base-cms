							<aside>
								<div class="aside-title">
									{{__('master.Recent Posts')}}
								</div>
								<div class="aside-body">
									<ul>
										@foreach($recent as $item)
										<li>
											<a href="{{route('frontend.single', $item->slug)}}">
												<h2>
													{{truncate($item->title, 70)}}
													<div class="time">{{date('M d, Y', strtotime($item->created_at))}}</div>
												</h2>
											</a>
										</li>
										@endforeach
									</ul>
								</div>
							</aside>
							<aside>
								<div class="aside-title">
									{{__('master.Archive')}}
								</div>
								<div class="aside-body">
									<ul>
										@foreach($archive as $m=>$item)
										<li>
											<a href="#">
												<h2>{{date('F', mktime(0, 0, 0, $m, 10))}}</h2>
											</a>
											<ul>
												@foreach($item as $it)
													<li><a href="{{route('frontend.single',$it->slug)}}">{{truncate($it->title, 70)}}</a></li>
												@endforeach												
											</ul>
										</li>
										@endforeach
									</ul>
								</div>
							</aside>
