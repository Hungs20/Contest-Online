
	<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Colorlib Templates">
    <meta name="author" content="Colorlib">
    <meta name="keywords" content="Colorlib Templates">

    <!-- Title Page-->
    <title><?= $title ?></title>

   <!-- Icons font CSS-->
     <!-- Font special for pages-->
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

   
    <!-- Icons font CSS-->
    <link href="../../public/vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">
    <link href="../../public/vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">

     <!-- Vendor CSS-->
    <link href="../../public/vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="../../public/vendor/datepicker/daterangepicker.css" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="../../public/css/main.css" rel="stylesheet" media="all">
	
</head>

<body>
    <div class="page-wrapper bg-gra-02 p-t-130 p-b-100 font-poppins">
        <div class="wrapper wrapper--w680">
            <div class="card card-4">
                <div class="card-body">
                    <h2 class="title">Tạo cuộc thi</h2>
                    <form method="POST">
					
                        <div class="row row-space">
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label"><font color = "red">*</font> Tên cuộc thi</label>
                                    <input class="input--style-4" type="text" name="name">
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">Mật khẩu</label>
                                    <input class="input--style-4" type="text" name="password">
                                </div>
                            </div>
                        </div>
						<div class="row row-space">
                            <div class="col-3">
                                <label class="label"><font color = "red">*</font> Thời gian bắt đầu</label>
                                <div class="input-group-icon">
                                    <input class="input--style-4 js-datepicker" type="text" name="startTime"/>
									<i class="zmdi zmdi-calendar-note input-icon js-btn-calendar"></i>
                                </div>
                            </div>
							<div class="col-3">
								<div class="input-group">
									<label class="label">Giờ</label>
									<div class="rs-select2 js-select-simple select--no-search">
										<select name="gio">
											<option selected="selected">01</option>
											<option>02</option>
											<option>03</option>
											<option>04</option>
											<option>05</option>
											<option>06</option>
											<option>07</option>
											<option>08</option>
											<option>09</option>
											<option>10</option>
											<option>11</option>
											<option>12</option>
										</select>
										<div class="select-dropdown"></div>
									</div>
								</div>
							</div>
							<div class="col-3">
								<div class="input-group">
									<label class="label">Phút</label>
									<div class="rs-select2 js-select-simple select--no-search">
										<select name="phut">
											<option selected="selected">00</option>
											<option>01</option>
											<option>02</option>
											<option>03</option>
											<option>04</option>
											<option>05</option>
											<option>06</option>
											<option>07</option>
											<option>08</option>
											<option>09</option>
											<option>10</option>
											<option>11</option>
											<option>12</option>
											<option>13</option>
											<option>14</option>
											<option>15</option>
											<option>16</option>
											<option>17</option>
											<option>18</option>
											<option>19</option>
											<option>20</option>
											<option>21</option>
											<option>22</option>
											<option>23</option>
											<option>24</option>
											<option>25</option>
											<option>26</option>
											<option>27</option>
											<option>28</option>
											<option>29</option>
											<option>30</option>
											<option>31</option>
											<option>32</option>
											<option>33</option>
											<option>34</option>
											<option>35</option>
											<option>36</option>
											<option>37</option>
											<option>38</option>
											<option>39</option>
											<option>40</option>
											<option>41</option>
											<option>42</option>
											<option>43</option>
											<option>44</option>
											<option>45</option>
											<option>46</option>
											<option>47</option>
											<option>48</option>
											<option>49</option>
											<option>50</option>
											<option>51</option>
											<option>52</option>
											<option>53</option>
											<option>54</option>
											<option>55</option>
											<option>56</option>
											<option>57</option>
											<option>58</option>
											<option>59</option>
										</select>
										<div class="select-dropdown"></div>
									</div>
								</div>
							</div>
							
							<div class="col-3">
								<div class="input-group">
								<label class="label">Buổi</label>
									<div class="rs-select2 js-select-simple select--no-search">
										<select name="sc">
											<option selected="selected">AM</option>
											<option>PM</option>
										</select>
										<div class="select-dropdown"></div>
									</div>
								</div>
							</div>
							
							
                        </div>
						<div class="row row-space">
                            <div class="col-3">
                                <div class="input-group">
                                    <label class="label"><font color = "red">*</font> Thời gian làm bài (Phút)</label>
                                    <input class="input--style-4" type="number" name="duringTime" value = "120">
                                </div>
                            </div>
						
							<div class="col-6">
                                <div class="input-group">
                                    <label class="label"><font color = "red">*</font> ID các đề trong cuộc thi ( VD: 1 3 9 )</label>
                                    <input class="input--style-4" type="text" name="listIdProblem">
                                </div>
                            </div>
						</div>
						<div class="col-5">
                                <div class="input-group">
                                    <label class="label">Mô tả</label>
                                    <textarea  class="input--style-4" type="text" name="mota"></textarea>
                                </div>
                            </div>
                        <div class="p-t-15">
                            <button class="btn btn--radius-2 btn--blue" type="submit" name = "create">Tạo</button>
							<?php echo '<font color = "red"> '.@$err.'</font>'; ?>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
	<!-- Jquery JS-->
    <script src="../../public/vendor/jquery/jquery.min.js"></script>
    <!-- Vendor JS-->
    <script src="../../public/vendor/select2/select2.min.js"></script>
    <script src="../../public/vendor/datepicker/moment.min.js"></script>
    <script src="../../public/vendor/datepicker/daterangepicker.js"></script>

    <!-- Main JS-->
    <script src="../../public/js/global.js"></script>
</body><!-- This templates was made by Colorlib (https://colorlib.com) -->

</html>
	