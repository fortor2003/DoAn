package pl.banhangtichluy.controller.page;

public class MessageResponse {
    private String code;
    private String msg;
    private Object data;
    private String sign;

    public MessageResponse() {
        super();
        // TODO Auto-generated constructor stub
    }

    public MessageResponse(String code, String msg, Object data, String sign) {
        super();
        this.code = code;
        this.msg = msg;
        this.data = data;
        this.sign = sign;
    }

    public MessageResponse(String code, String msg, Object data) {
        super();
        this.code = code;
        this.msg = msg;
        this.data = data;
        this.sign = "";
    }

    public MessageResponse(String code, String msg) {
        super();
        this.code = code;
        this.msg = msg;
        this.data = "";
        this.sign = "";
    }

    public String getCode() {
        return code;
    }
    public void setCode(String code) {
        this.code = code;
    }
    public String getMsg() {
        if(msg.equalsIgnoreCase("403 null")) {
            return "Tài khoản không được cấp quyền truy cập, liên hệ quản trị";
        }
        return msg;
    }
    public void setMsg(String msg) {
        this.msg = msg;
    }
    public Object getData() {
        return data;
    }
    public void setData(Object data) {
        this.data = data;
    }
    public String getSign() {
//		if(this.data != null && this.sign != null) {
//			return Checksum.getMD5Checksum(this.data);
//		}
        return sign;
    }
    public void setSign(String sign) {
        this.sign = sign;
    }
}
