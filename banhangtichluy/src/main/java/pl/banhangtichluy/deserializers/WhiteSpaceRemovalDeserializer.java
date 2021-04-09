package pl.banhangtichluy.deserializers;

import com.fasterxml.jackson.core.JsonParser;
import com.fasterxml.jackson.core.JsonProcessingException;
import com.fasterxml.jackson.databind.DeserializationContext;
import com.fasterxml.jackson.databind.JsonDeserializer;

import java.io.IOException;

public class WhiteSpaceRemovalDeserializer extends JsonDeserializer<String> {

    @Override
    public String deserialize(JsonParser p, DeserializationContext ctxt) throws IOException, JsonProcessingException {
        if (p.getText() != null) {
            String before =  p.getText().trim();
            if (!before.equals("")) {
                return before.replaceAll("\\s+"," ");
            }
        }
        return null;
    }

}
