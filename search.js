//뒤로가기 버튼
$("#backbtn").click(function () {
	location.href = "http://localhost/web/main/";
});
//로고누르면 홈으로 이동
$(".logo").click(function () {
	location.replace('/web/main');
});

$(".select_text1").change(function () {
	var selectOption = parseInt($(this).val());
	console.log(selectOption);

	$.ajax({
		type: "POST",
		url: "/web/page_save/save_pageData",
		data: { per_page: selectOption },
		success: function(response) {
			location.reload()
		}
	});
});
//검색
$("#search_btn").click(function () {
	var searchKeyword = $("#search_text").val();
	if (!searchKeyword) {
		alert('검색어를 입력하세요!');
		return;
	}

	$.ajax({
		type: "POST",
		dataType: "JSON",
		url: "/web/searchBoard/company_Info",
		data: { searchKeyword: searchKeyword },
		success: function (res) {
			console.log('success');
			var tableBody = $('#searchBoard tbody');
			tableBody.empty();

			// 검색 결과가 있을 때
			if (res && res.length > 0) {
				$.each(res, function (index, item) {
					var newRow = '<tr>' +
						'<td>' + (index + 1) + '</td>' +
						'<td>' + item.company_nm + '</td>' +
						'<td>' + item.Business_num + '</td>' +
						'<td>' + item.company_section + '</td>' +
						'<td>' + item.company_boss + '</td>' +
						'<td>' + item.company_address + '</td>' +
						'<td>' + item.address_num + '</td>' +
						'<td>' + item.company_phone + '</td>' +
						'</tr>';
					tableBody.append(newRow);
				});
			}
			// 검색 결과가 없을 때
			else {
				tableBody.html('<tr><td colspan="8">No company information available</td></tr>');
			}
		},
		error: function (xhr, textStatus) {
			console.error('Error:', textStatus);
		}
	});
});










