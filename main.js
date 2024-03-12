// 슬라이드 기능
const slides = document.querySelectorAll('.slides div');
let currentSlide = 0;

function showSlide(n) {
	slides.forEach(slide => slide.classList.remove('active'));
	currentSlide = (n + slides.length) % slides.length;
	slides[currentSlide].classList.add('active');
}
function nextSlide() {
	showSlide(currentSlide + 1);
}

function prevSlide() {
	showSlide(currentSlide - 1);
}
document.querySelector('.next').addEventListener('click', nextSlide);
document.querySelector('.prev').addEventListener('click', prevSlide);

// 자동 슬라이드
setInterval(nextSlide, 3000); // 3초마다 다음 슬라이드로 이동

// 로그인
function loginMember() {
	var data = {
		'mem_id' : $("#mem_id").val(),
		'mem_pw' : $("#mem_pw").val(),
	};
	console.log(data);

	$.ajax({
		dataType    : "JSON",
		url         : "/web/login/memberLogin",
		type        : "POST",
		data        : data,
		success: function (res) {
			if (res.success) {
				alert("로그인 성공!");
				window.location.href = "http://localhost/web/main";
			} else {
				alert("로그인 실패");
			}
		},
		error: function (xhr, textStatus) {
			alert("서버연결오류");
		}
	});
}
// 엔터 키를 눌렀을 때
$(document).keypress(function(event) {
	if (event.which == 13) {
		event.preventDefault();
		if (confirm("로그인 하시겠습니까?")) {
			loginMember();
		}
	}
});
$("#confirm").click(function () {
	if (confirm("로그인 하시겠습니까?")) {
		performLogin();
	}
});
// 로그아웃
$("#mem_logout").click(function () {
	if (confirm("로그아웃 하시겠습니까?")) {
		$.ajax({
			url: "/web/logout/destroySession",
			type: "POST",
			success: function (res) {
				alert("로그아웃 되었습니다.");
				window.location.reload();
			},
			error: function (xhr, status, error) {
				alert("로그아웃 중 오류가 발생했습니다.");
			}
		});
	}
});

// go to search 페이지 이동
$("#go-board").click(function () {
	location.replace('/web/searchBoard/company_Info')
});

// 로고누르면 홈으로 이동

$(".logo").click(function () {
	location.replace('/web/main');
});
