<?php
/* @var $this yii\web\View */

use backend\assets\TableAsset;

TableAsset::register( $this );

?>

<style>
    .form-inline input, select {
        min-height: 33px;
    }

    .form-inline {
        margin-bottom: 5px;
    }

    .avatar-facebook img {
        height: 20px;
        width: 20px;
        border-radius: 50%;
    }

</style>

<section class="content-header">
    <div class="page-heading page-heading-md">
        <h2 class="header__main">
            <span class="breadcrumb hidden-xs">
                <i class="fa fa-tags"></i>
            </span>
            <span class="title">
                <?= Yii::t( 'backend', 'Quét UID bạn bè' ) ?>
            </span>
        </h2>
    </div>
</section>
<section class="content" style="margin-top: 30px;">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <div class="form-inline">
                        <div class="form-group">Lọc theo tuổi</div>
                        <div class="form-group">
                            <input type="number" id="age_min" placeholder="Tuổi từ" value="0">
                        </div>
                        <div class="form-group">
                            <input type="number" id="age_max" placeholder="Tuổi từ" value="50">
                        </div>
                        <div class="form-group">
                            <select title="" id="sex">
                                <option value="All">Tất cả</option>
                                <option value="Nam">Nam</option>
                                <option value="Nữ">Nữ</option>
                                <option value="Không xác định">Không xác định</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <button id="filter" class="btn btn-effect-ripple btn-primary">Lọc</button>
                        </div>
                        <div class="btn-group" id="submit_save" style="">
                            <a href="javascript:void(0)" data-toggle="dropdown" class="btn btn-default dropdown-toggle"
                               aria-expanded="false">Lưu thông tin
                                <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu text-left">
                                <li>
                                    <a href="javascript:void(0)" id="submit_uid_save">
                                        <i class="fa fa-pencil pull-right"></i>
                                        Lưu UID
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)" id="submit_email_save">
                                        <i class="fa fa-cog pull-right"></i>
                                        Lưu Email ( nếu có)
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)" id="submit_phone_save">Lưu số điện thoại (nếu có)</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="form-inline">
                        <button type="button" class="btn btn-primary" onclick="get_list_friend()">
                            Lấy danh sách bạn bè
                        </button>
                        <button class="btn btn-info" id="export">Xuất excel</button>
                        <button class="btn btn-info" id="loadmore"
                                data-next="https://graph.facebook.com/v2.10/100002698820021/friends?access_token=EAAAAUaZA8jlABAEKktMAkgvfeVHoclvnY6p9f2YOFeiBud1mShMZCjD67VtZAvU96blatWdOlpQcS9oVdpbY6Lm96fEFqc864JScSBrK7x15l8MSHJkFhM0DKWggZCNRZCuWwoNx5uoOqieo5PaD6kZClxV3UOwz4ZD&amp;pretty=1&amp;fields=id%2Cname%2Cemail%2Clocation%2Cbirthday%2Cgender&amp;limit=300&amp;after=QVFIUnNESFJHOTc5bHVmX1p5TUVrTTNJX0dwQl8ySjVSdWo3aF9YSGx6NEgtQ3ZAvWkpYUGRxTVBHTEpqaWtuczBfWGZAlU21GSmdqS21ibWJWTldjMmJzWWxn"
                                style="">Tải thêm danh sách
                        </button>
                        <button class="btn btn-danger" type="button" id="empty">Xóa danh sách</button>
                    </div>
                </div>
                <div class="box-body">
                    <div class="dataTables_wrapper form-inline dt-bootstrap">
                        <div class="row">
                            <div class="col-sm-12">
                                <table id="table-temp" style="display: none">
                                    <tr role="row">
                                        <td class="action-table" style="padding-left: 15px;">
                                            <input title="" type="checkbox" class="minimal">
                                        </td>
                                        <td class="uid"></td>
                                        <td class="email"></td>
                                        <td class="name"><a href="" target="_blank"></a></td>
                                        <td class="gender"></td>
                                        <td class="birthday"></td>
                                        <td class="location"></td>
                                    </tr>
                                </table>
                                <table id="table-list-friend" class="table table-bordered table-striped dataTable">
                                    <thead>
                                    <tr role="row">
                                        <th style="padding-left: 15px;">
                                            <input title="" type="checkbox" class="minimal">
                                        </th>
                                        <th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1"
                                            colspan="1" aria-sort="ascending"
                                            aria-label="Rendering engine: activate to sort column descending">
                                            UID
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"
                                            colspan="1" aria-label="Platform(s): activate to sort column ascending">
                                            Email
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"
                                            colspan="1" aria-label="Engine version: activate to sort column ascending">
                                            Họ và tên
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"
                                            colspan="1" aria-label="CSS grade: activate to sort column ascending">
                                            Giới tính
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"
                                            colspan="1" aria-label="CSS grade: activate to sort column ascending">
                                            Tuổi
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"
                                            colspan="1" aria-label="CSS grade: activate to sort column ascending">
                                            Quê quán
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="overlay" style="display: none">
                    <i class="fa fa-refresh fa-spin"></i>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        $('#table-list-friend').DataTable({
            'paging': true,
            'lengthChange': false,
            'searching': true,
            'ordering': true,
            'info': false,
            'autoWidth': false
        })
    });
</script>