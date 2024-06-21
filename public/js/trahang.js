window.onload = () => {
    const danhSachTraItems = document.querySelectorAll(".danh-sach-tra-item");
    const tongSoLuongEle = document.querySelector(".tong-so-luong");
    const tongGiaEle = document.querySelector(".tong-gia");
    const btnSubmitTrahang = document.querySelector(".btn-submit-trahang");
    const idHoadonXuatEle = document.querySelector(".id-hoa-don-xuat");
    const idKhachHangEle = document.querySelector(".id-khach-hang");
    const urlBackendTrahangEle = document.querySelector(".url-backend-trahang");

    danhSachTraItems.forEach((danhSachTraItem) => {
        const soLuongTra = danhSachTraItem.querySelector(".so-luong-tra");
        const soLuongMua = danhSachTraItem.querySelector(".so-luong-mua");
        console.log(soLuongTra, soLuongMua);
        soLuongTra.onchange = (e) => {
            if (
                +e.target.value <= +soLuongMua.innerText &&
                e.target.value >= 0
            ) {
                setTong();
                return;
            }
            e.target.value = 0;
            alert("Số lượng trả phải bé hơn số lượng mua");
            setTong();
        };
    });
    const setTong = () => {
        let tongSoLuong = 0;
        let tongGia = 0;
        danhSachTraItems.forEach((danhSachTraItem) => {
            const soLuongTra = danhSachTraItem.querySelector(".so-luong-tra");
            const gia = danhSachTraItem.querySelector(".gia");
            if (soLuongTra.value && soLuongTra.value > 0) {
                tongSoLuong += +soLuongTra.value;
                tongGia += +soLuongTra.value * gia.innerText;
            }
        });

        tongSoLuongEle.value = tongSoLuong;
        tongGiaEle.value = tongGia;
    };

    btnSubmitTrahang.onclick = async () => {
        if (!tongSoLuongEle.value || +tongSoLuongEle.value <= 0) {
            alert("điền số lượng trả cho sản phẩm");
            return;
        }
        const sanphams = [];
        danhSachTraItems.forEach((danhSachTraItem) => {
            const soLuongTra = danhSachTraItem.querySelector(".so-luong-tra");
            const idSanpham = danhSachTraItem.querySelector(".id-sanpham");
            if (!soLuongTra.value || +soLuongTra.value <= 0) {
                return;
            }
            sanphams.push({
                id: idSanpham.value,
                soluong: soLuongTra.value,
            });
        });

        const tongGiaTra = tongGiaEle.value;
        const tongSoLuong = tongSoLuongEle.value;
        const idHoadonXuat = idHoadonXuatEle.value;
        const idKhachHang = idKhachHangEle.value;

        const formData = new FormData();
        formData.append("tongGiaTra", tongGiaTra);
        formData.append("tongSoLuong", tongSoLuong);
        formData.append("idHoadonXuat", idHoadonXuat);
        formData.append("idKhachHang", idKhachHang);
        formData.append("sanphams", JSON.stringify(sanphams));
        console.log(tongGiaTra, tongSoLuong, idHoadonXuat, idKhachHang);

        try {
            const res =   await fetch(urlBackendTrahangEle.value, {
                method: "POST",
                body: formData,
                headers: {
                    "Accept-Content-Type": "aplication/json",
                },
            });
            if (res.ok) {
                
                alert("Thành công");
                history.back();
            } else {
            alert("Có lỗi!");
            }
        } catch (error) {
            alert("Có lỗi!");
        }
    };
};
