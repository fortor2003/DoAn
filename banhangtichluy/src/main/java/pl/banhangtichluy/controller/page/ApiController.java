package pl.banhangtichluy.controller.page;

import org.springframework.web.bind.annotation.*;

@RestController
@RequestMapping("api/")
public class ApiController {
//    @Autowired
//    IThe theDAO;
//    @Autowired
//    IDiem diemDAO;
//    @GetMapping("the/{maso}/v1")
//    public MessageResponse thongTinThe(@PathVariable(required = true) String maso){
//        try {
//            return new MessageResponse("200", "thành công",theDAO.findByMaSo(maso));
//        }catch (Exception e){
//            return new MessageResponse("500", e.getMessage());
//        }
//    }
//
//    @PostMapping("the/cap-nhat-point/v1")
//    public MessageResponse addPoint(@RequestBody FrmThe frmThe){
//        try {
//            The the = theDAO.findById(frmThe.getId());
//            Diem diem = diemDAO.findByLoaiThe(1L);
//            The newThe = new The();
//            newThe.setId(the.getId());
//            newThe.setMaSo(the.getMaSo());
//            newThe.setDiem(the.getDiem()+diem.getDiem());
//            return new MessageResponse("200", "");
//        }catch (Exception e){
//            return new MessageResponse("500", e.getMessage());
//        }
//    }
//
//    @GetMapping("diem/v1")
//    public MessageResponse thongTinDiem(){
//        try {
//            return new MessageResponse("200", "thành công",diemDAO.findByLoaiThe(1L));
//        }catch (Exception e){
//            return new MessageResponse("500", e.getMessage());
//        }
//    }


    
}
