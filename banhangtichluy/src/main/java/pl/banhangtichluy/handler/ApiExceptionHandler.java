package pl.banhangtichluy.handler;

import org.springframework.http.HttpStatus;
import org.springframework.http.ResponseEntity;
import org.springframework.validation.BindException;
import org.springframework.web.bind.MethodArgumentNotValidException;
import org.springframework.web.bind.annotation.ControllerAdvice;
import org.springframework.web.bind.annotation.ExceptionHandler;
import org.springframework.web.server.ResponseStatusException;

@ControllerAdvice
public class ApiExceptionHandler {

    @ExceptionHandler(ResponseStatusException.class)
    public ResponseEntity<Object> handleResponseStatusException(ResponseStatusException ex) {
        return new ResponseEntity<>(ex.getReason(), ex.getStatus());
    }

    @ExceptionHandler(MethodArgumentNotValidException.class)
    public ResponseEntity<Object> handleMethodArgumentNotValidException(MethodArgumentNotValidException ex) {
        return new ResponseEntity<>(ex.getAllErrors(), HttpStatus.BAD_REQUEST);
    }

    @ExceptionHandler(BindException.class)
    public ResponseEntity<Object> handleBindException(BindException ex) {
        return new ResponseEntity<>(ex.getAllErrors(), HttpStatus.BAD_REQUEST);
    }

//    @ExceptionHandler(DataIntegrityViolationException.class)
//    public ResponseEntity<Object> handleDataIntegrityViolationException(DataIntegrityViolationException ex) {
//        if (ex.getCause().getCause() instanceof ConstraintViolationException) {
//            ConstraintViolationException violationException = (ConstraintViolationException) ex.getCause().getCause();
//            if ()
//        }
//        return new ResponseEntity<>(ex.getMessage(), HttpStatus.BAD_REQUEST);
//    }

//    @ExceptionHandler(Exception.class)
//    public ResponseEntity<Object> handleException(Exception ex) {
//        return new ResponseEntity<>(ex.getMessage(), HttpStatus.INTERNAL_SERVER_ERROR);
//    }

}
