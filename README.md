# works
과거에 개발했던 공간 입니다.

##### 1. [업무관리시스템(2012.7.3 ~ 2012.12.20) (GO)](https://github.com/yunsungKim/works/tree/master/smartWorker)<br/>
<img src="https://raw.githubusercontent.com/yunsungKim/works/master/smartWorker/img.png" width="200px"/><br/>
> 삼성SDS 재직시절 개발한 시스템으로, 부서내 비효율적인 업무공유환경을 개선하고자 만든 시스템. 아쉽게도 보안관계상 소스확보는 못하였음. jQgrid와 jQuery.Gantt(https://github.com/taitems/jQuery.Gantt) 플러그인을 사용하여 도표와 간트차트를 구현하였으며 부트스트랩으로 기본 디자인완성함. 개발후 부서내에서 실사용되었던 시스템. 

<br/>
##### 1. [쿠폰셔틀(2011.5.10 ~ 2011.11.20) (GO)](https://github.com/yunsungKim/works/old/tree/master/couponShuttle)<br/>
<img src="https://raw.githubusercontent.com/yunsungKim/works/master/couponShuttle/%EC%BF%A0%ED%8F%B0%EC%85%94%ED%8B%80.png" width="200px"/>
<img src="https://raw.githubusercontent.com/yunsungKim/works/master/couponShuttle/%EC%BF%A0%ED%8F%B0%EC%85%94%ED%8B%801.png" width="200px"/><br/>
> 소셜 커머스 정보를 한 눈에 볼 수 있는 메타 사이트 개발 프로젝트이다. 기획당시 일반 원어데이에 관한 메타 사이트는 있었지만, 전문적으로 소셜커머스만 대상으로 하는 메타사이트업체는 없었기 때문에 기획하게 되었으며, 소셜커머스 사이트 특성상 지역에 의존적인 서비스가 많았기 때문에 지도API로 해당 정보를 지도에 표시하는 방식으로 업체들의 정보를 한눈에 보기 쉽게 하였다. 개발 초기 업주들의 입점여부가 불투명하여, 해당 사이트에서 필요한 정보만 크롤링하는 방식으로 우선 정보를 모았고, 그 후 사이트 홍보와 xml 규격 포맷을 정의하여 대상 업체에 데이터 제공을 요청 하였다. 스케쥴러를 통해 10분간격으로 해당업체들의 xml포맷들을 읽어오고 DB에 저장하는 방식이다. 초장기에는 이미지 파일들의 저장을 우리 쪽으로 하지 않고 해당업체의 이미지경로를 직접 불러 들어오는 식으로 하여 트래픽 부담을 줄이고자 하였으나 페이지 로딩이 느리거나 링크가 깨지는 등의 문제점이 발생하여 현재는 서버를 확충하고 해당업체들의 이미지를 직접 저장하여 로딩해주고 있다. 2011년 2월 17일, 현재기준으로 일일 평균 5000건 정도의 PV를 기록하고 있다.

<br/>
##### 2. [보건복지부 마더(2011.9.12 ~ 2011.10.26) (GO)](https://github.com/yunsungKim/works/old/tree/master/mother_event)<br/>
<img src="https://raw.githubusercontent.com/yunsungKim/works/master/mother_event/images/bg_intro.png" width="200px"/>
> 보건복지부 마더 모바일 이벤트 페이지 작업 진행건

<br/>
##### 3. [유플러스 WIFI 이벤트 페이지(2011.9.1 ~ 23) (GO)](https://github.com/yunsungKim/works/old/tree/master/uplus_wifi_event)<br/>
<img src="https://raw.githubusercontent.com/yunsungKim/works/master/uplus_wifi_event/images/bg_event.png" width="200px"/>
> 유플러스 Wifi zone 모바일 이벤트 페이지 작업 진행건

<br/>
#####4. [IBK 이벤트(2010.11.1 ~ 2011.8.30) (GO)](https://github.com/yunsungKim/works/old/tree/master/ibk_event)<br/>
<img src="https://raw.githubusercontent.com/yunsungKim/works/master/ibk_event/images/bg_main.png" width="200px"/>
> 2010년 11월에 시작하여 2011년 8월까지 진행했던 있는 모바일 이벤트 페이지. 월 단위 씩 새로운 이벤트로 바뀌는 프로젝트 이며, 참여자 유도를 위해 기프티콘 등을 경품으로 주는 형식이다. 
<br/>이벤트의 목적이 다양한 참여자를 이끌어 내서 홍보를 함이기 때문에 효과적인 중복참여자를 확인하는 것이 중요하였다. 중복 참여자를 막기 위해 전화번호 중복 입력 방지등과 IP중복 참여 방지를 사용하였고, 모바일의 특성상 IP의 변환이 쉽게 가능하므로 html5에서 제공하는 localStorage를 이용하여 해당 단말기의 참여 여부를 추가로 확인 가능하게 설계하였다. 서버사이드 단에서 브라우저에이전트의 필터링으로 해당접속이 모바일인지 일반PC접속인지 확인하여 모바일사용자만 접속가능케 하는 코드를 넣었는데, 사파리 등과 같은 브라우저에서는 브라우저에이전트의 변환을 손쉽게 할 수 있기 때문에 100% 필터링이 불가능 하였다. 하여, 모바일에서만 반응하는 터치이벤트인 ontouch 이벤트를 통하여, 모바일에서만 반응할 수 있는 UX로 개선하였다.

<br/>
#####5. [코란도C 이벤트(2011.6.21 ~ 27) (GO)](https://github.com/yunsungKim/works/old/tree/master/KorandoC_event)<br/>
<img src="https://raw.githubusercontent.com/yunsungKim/works/master/KorandoC_event/images/bg_main.png" width="200px"/>
> 코란도C 출시기념 모바일 이벤트 페이지 작업 진행건

<br/>
##### 6. [롯데백화점 스크래치 이벤트(2011.1.12 ~ 2011.3.25) (GO)](https://github.com/yunsungKim/works/old/tree/master/lotte_event)<br/>
<img src="https://raw.githubusercontent.com/yunsungKim/works/master/lotte_event/img/bg.jpg" width="200px"/>
> html5의 canvas요소를 이용하여 복권긁기 이벤트를 진행. 전국 롯데백화점 단기 이벤트에 대한 프로모션 페이지 작업 진행건

<br/>
##### 7. [모비잽 기본페이지(2011.5.10 ~ 13) (GO)](https://github.com/yunsungKim/works/old/tree/master/mobizap_event)<br/>
<img src="https://raw.githubusercontent.com/yunsungKim/works/master/mobizap_event/main.png" width="200px"/>
> 모비잽 광고회사의 광고 의뢰페이지를 만들었던 작업

<br/>
#####8. [배틀바나나(2010.4.12 ~ 2010.12.15) (GO)](https://github.com/yunsungKim/works/old/tree/master/battleBanana)<br/>
<img src="https://raw.githubusercontent.com/yunsungKim/works/master/battleBanana/images/%EB%B0%B0%EB%B0%94.png" width="400px"/>
> 현재 나와있는 JS 프레임워크 중 개발이 비교적 간편한 JQuery를 사용하여 Ajax를 구현하였고, 데이터 전달 방법으로는 JS에 최적화된 Json을 이용하였다. 시간 카운트 다운은 1초마다 서버의 시각내용을 Json으로 불러들여와서 문서에 뿌려주는 구조이다. 특히 자동으로 입찰을 해주는 기능구현은 클라이언트 상에서는 구현이 불가능하여, Linux에서 제공하는 Cron 스케쥴러를 이용하여 매 분마다 따로 작업한 php파일을 불러들이는 방식을 사용하였다. 경매등록 부분은 간편한 html코드 삽입이 가능하도록 네이버에서 제공하는 SmartEditor를 이용 하였다.

<br/>
##### 9. [일정관리 다이어리(2009.11.25 ~ 2009.12.20) (GO)](https://github.com/yunsungKim/works/old/tree/master/diary)<br/>
<img src="https://raw.githubusercontent.com/yunsungKim/works/master/diary/%EC%9D%BC%EC%A0%95%EA%B4%80%EB%A6%AC%20%EB%8B%A4%EC%9D%B4%EC%96%B4%EB%A6%AC.png" width="200px"/>
> 일정관리 일정의 저장과 열람이 가능한 스케쥴 관리 프로그램이다. 플래시(AS 2.0)와 포토샵을 사용하여 UX를 구성하였고, 메뉴는 크게 Xml형식으로 일정을 저장하는 일정관리, Xml을 로드해서 보여주는 일정보기, D-day계산, 시간 보기의 총4가지로 구성되어 있다.