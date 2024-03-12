// 중복 확인 상태를 저장할 변수
var IdChecked = false;

// 중복확인 버튼 클릭 시
$("#confirmId").click(function () {
	var data = {
		'checkId': $("#members_id").val(),
	}
	// 아이디를 적지 않았을 때 처리
	if (!data['checkId'].trim()) {
		alert('아이디를 입력해주세요');
		return;
	}
	$.ajax({
		dataType: "JSON",
		url: "/web/signup/checkId",
		type: "POST",
		data: data,
		success: function (res) {
			if (res.result === "success") {
				alert("사용할 수 없는 아이디입니다");
			} else {
				alert("사용할 수 있는 아이디입니다.")
				IdChecked = true;
			}
		},
		error: function (xhr, textStatus) {
			// 에러 처리
		}
	});
});

// 회원가입 버튼 클릭 시
$("#sign").click(function () {
	// 중복 확인이 이루어지지 않았을 때 처리
	if (!IdChecked) {
		alert('아이디 중복 확인을 먼저 해주세요.');
		return;
	}

	if (confirm("회원가입 하시겠습니까?")) {
		var data = {
			'members_id'	: $("#members_id").val(),
			'members_pw'	: $("#members_pw").val(),
			'members_nm'	: $("#members_nm").val(),
			'members_email'	: $("#members_email").val(),
			'members_birth'	: $("#members_birth").val(),
		}
		// 빈 문자열 확인
		if (!(data['members_id']).trim()) {
			alert('아이디가 없습니다.');
			return;
		}
		if (!(data['members_pw']).trim()) {
			alert('비밀번호가 없습니다.');
			return;
		}
		if (!(data['members_nm']).trim()) {
			alert('이름이 없습니다.');
			return;
		}
		if (!(data['members_email']).trim()) {
			alert('이메일이 없습니다.');
			return;
		}
		if (!(data['members_birth']).trim()) {
			alert('생년월일이 없습니다.');
			return;
		}
		$.ajax({
			dataType	: "JSON",
			url			: "/web/signup/insertMember",
			type		: "POST",
			data		: data,
			success: function (res) {
				alert("회원가입이 완료되었습니다.");
				window.location.href = "http://localhost/web/main";
			},
			error: function (xhr, textStatus) {
				alert("회원가입이 실패했습니다.")
			}
		});
	}
});
//로고 누르면 홈으로 이동
$(".logo").click(function () {
	location.replace('/web/main');
});


