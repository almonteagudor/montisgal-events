namespace montisgal_events.domain.Shared.Exceptions;

public class MaxLengthException(int maxLength) : Exception
{
    public int MaxLength { get; } = maxLength;
}