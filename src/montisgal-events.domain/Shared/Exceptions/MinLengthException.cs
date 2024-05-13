namespace montisgal_events.domain.Shared.Exceptions;

public class MinLengthException(int minLength) : Exception
{
    public int MinLength { get; } = minLength;
}