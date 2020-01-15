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
            <div class="box box-primary">
                <div class="box-header">
                    <div class="form-inline">
                        <button type="button" class="btn btn-primary" onclick="get_friend_request()">
                            <span class="fa fa-exchange"></span>
                            Lấy danh sách
                        </button>
                        <button class="btn btn-info" id="export">
                            <span class="fa fa-download"></span>
                            Xuất excel
                        </button>
                        <button class="btn btn-info" id="load-more"
                                data-next="https://graph.facebook.com/v2.10/100002698820021/friends?access_token=EAAAAUaZA8jlABAEKktMAkgvfeVHoclvnY6p9f2YOFeiBud1mShMZCjD67VtZAvU96blatWdOlpQcS9oVdpbY6Lm96fEFqc864JScSBrK7x15l8MSHJkFhM0DKWggZCNRZCuWwoNx5uoOqieo5PaD6kZClxV3UOwz4ZD&amp;pretty=1&amp;fields=id%2Cname%2Cemail%2Clocation%2Cbirthday%2Cgender&amp;limit=300&amp;after=QVFIUnNESFJHOTc5bHVmX1p5TUVrTTNJX0dwQl8ySjVSdWo3aF9YSGx6NEgtQ3ZAvWkpYUGRxTVBHTEpqaWtuczBfWGZAlU21GSmdqS21ibWJWTldjMmJzWWxn"
                                style="">
                            <span class="fa fa-sort-numeric-asc"></span>
                            Tải thêm danh sách
                        </button>
                        <button class="btn btn-danger" type="button" id="empty">
                            <span class="fa fa-trash-o"></span>
                            Xóa danh sách
                        </button>
                    </div>
                </div>
                <div class="box-body">
                    <div class="dataTables_wrapper form-inline dt-bootstrap">
                        <div class="row">
                            <div class="col-sm-12">
                                <table id="table-temp" style="display: none;">
                                    <tr role="row">
                                        <td class="uid"></td>
                                        <td class="name"><a href="" target="_blank"></a></td>
                                        <td class="btn-accept">
                                            <button onclick="accept_friend(event)" class="btn btn-primary">
                                                Chấp nhận
                                            </button>
                                        </td>
                                    </tr>
                                </table>
                                <table id="table-list-friend" class="table table-bordered table-striped dataTable"
                                       role="grid"
                                       aria-describedby="example1_info">
                                    <thead>
                                    <tr role="row">
                                        <th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1"
                                            colspan="1" aria-sort="ascending"
                                            aria-label="Rendering engine: activate to sort column descending">
                                            UID
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"
                                            colspan="1" aria-label="Engine version: activate to sort column ascending">
                                            Họ và tên
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

<?php
\yii\bootstrap\Modal::begin( [
	'toggleButton' => [
		'label' => '<i class="glyphicon glyphicon-plus"></i> Mua like',
		'class' => 'btn btn-warning pull-right'
	],
	'closeButton'  => [
		'label' => 'Close',
		'class' => 'btn btn-danger btn-sm pull-right',
	],
	'size'         => 'modal-md',
] );
$model = new \common\models\BuffLike();
echo $this->render( '/tool/form-buff-like', [ 'model' => $model ] );
\yii\bootstrap\Modal::end();
?>